<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    /**
     * Intercepte l’écriture d’un attribut pour le chiffrer si nécessaire
     */
    public function setAttribute($key, $value)
    {
        if (isset($this->encryptable) && in_array($key, $this->encryptable)) {
            $value = Crypt::encryptString($value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Intercepte la lecture d’un attribut pour le déchiffrer si nécessaire
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (isset($this->encryptable) && in_array($key, $this->encryptable) && !is_null($value)) {
            try {
                $value = Crypt::decryptString($value);
            } catch (\Exception $e) {
                // si le champ n’est pas chiffré, on retourne la valeur brute
            }
        }

        return $value;
    }
}
