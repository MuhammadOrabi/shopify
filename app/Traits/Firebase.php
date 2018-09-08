<?php

namespace App\Traits;

use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Factory;

/**
 *
 */
trait Firebase
{
    public function firebase()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(base_path().'/firebase.json');
        $firebase = (new Factory)->withServiceAccount($serviceAccount)->create();
        return $firebase->getStorage()->getFilesystem();
    }

    public function putFileAs($path, $file, $options = [])
    {
        $stream = fopen($file->getRealPath(), 'r');

        // Next, we will format the path of the file and store the file using a stream since
        // they provide better performance than alternatives. Once we write the file this
        // stream will get closed automatically by us so the developer doesn't have to.
        $result = $this->firebase()->put(
            $path = trim($path.'/'.$file->hashName(), '/'), $stream, $options
        );

        if (is_resource($stream)) {
            fclose($stream);
        }

        return $result ? $path : false;
    }
}
