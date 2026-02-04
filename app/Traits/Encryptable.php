<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    /**
     * Intercepts attribute setting to encrypt the value if needed
     */
    public function setAttribute($key, $value)
    {
        if (isset($this->encryptable) && in_array($key, $this->encryptable)) {
            $value = Crypt::encryptString($value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Intercepts attribute access to decrypt the value if needed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (isset($this->encryptable) && in_array($key, $this->encryptable) && !is_null($value)) {
            try {
                $value = Crypt::decryptString($value);
            } catch (\Exception $e) {
                // If the value is not encrypted, return the raw value
            }
        }

        return $value;
    }
}
