<?php

namespace klarnapayment\src\Http\Resources;

use Invertus\Http\Resources\MergeValue;
use Invertus\Http\Resources\PotentiallyMissing;

trait ConditionallyLoadsAttributes
{
    /**
     * Filter the given data, removing any optional values.
     *
     * @param  array  $data
     * @return array
     */
    protected function filter($data)
    {
        $index = -1;

        foreach ($data as $key => $value) {
            $index++;

            if (is_array($value)) {
                $data[$key] = $this->filter($value);

                continue;
            }

            if (is_numeric($key) && $value instanceof MergeValue) {
                return $this->mergeData(
                    $data, $index, $this->filter($value->data),
                    array_values($value->data) === $value->data
                );
            }

            if ($value instanceof self && is_null($value->resource)) {
                $data[$key] = null;
            }
        }

        return $this->removeMissingValues($data);
    }

    /**
     * Merge the given data in at the given index.
     *
     * @param  array  $data
     * @param  int  $index
     * @param  array  $merge
     * @param  bool  $numericKeys
     * @return array
     */
    protected function mergeData($data, $index, $merge, $numericKeys)
    {
        if ($numericKeys) {
            return $this->removeMissingValues(array_merge(
                array_merge(array_slice($data, 0, $index, true), $merge),
                $this->filter(array_values(array_slice($data, $index + 1, null, true)))
            ));
        }

        return $this->removeMissingValues(array_slice($data, 0, $index, true) +
                $merge +
                $this->filter(array_slice($data, $index + 1, null, true)));
    }

    /**
     * Remove the missing values from the filtered data.
     *
     * @param  array  $data
     * @return array
     */
    protected function removeMissingValues($data)
    {
        $numericKeys = true;

        foreach ($data as $key => $value) {
            if (($value instanceof PotentiallyMissing && $value->isMissing()) ||
                ($value instanceof self &&
                $value->resource instanceof PotentiallyMissing &&
                $value->isMissing())) {
                unset($data[$key]);
            } else {
                $numericKeys = $numericKeys && is_numeric($key);
            }
        }

        if (property_exists($this, 'preserveKeys') && $this->preserveKeys === true) {
            return $data;
        }

        return $numericKeys ? array_values($data) : $data;
    }
}
