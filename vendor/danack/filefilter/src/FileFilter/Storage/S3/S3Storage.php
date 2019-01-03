<?php

namespace FileFilter\Storage\S3;

use FileFilter\Storage\S3\S3ClientFactory;
use FileFilter\Storage;
use FileFilter\TmpPath;

class S3Storage implements Storage
{
    private $s3ClientFactory;

    private $bucket;

    const AMAZON_S3_PREFERRED_LOCATION = 's3-ap-southeast-1.amazonaws.com';

    private $tmpPath;
    
    function __construct(
        S3ClientFactory $s3ClientFactory,
        TmpPath $tmpPath
    ) {
        $this->s3ClientFactory = $s3ClientFactory;
        $this->tmpPath = $tmpPath;
        //@TODO - remove hard-coding
        $this->bucket = 'static.basereality.com'; //STATIC_BUCKET,
    }

    function downloadFile($storageFilename, $localFilename)
    {
        $region = $this->getS3RegionOfBucket($this->bucket);
        $s3 = $this->s3ClientFactory->createClient($region);

        // TODO - need to not use system dir.
        $tempFilename = tempnam(
            $this->tmpPath->getPath(),
            's3storage_'
        );

        $response = $s3->getObject([
            'Bucket' => $this->bucket,
            'Key'    => $storageFilename,
            'SaveAs' => $tempFilename
        ]);

        $fileSize = filesize($tempFilename);

        if ($fileSize == 0) {
            unlink($tempFilename);
            throw new \Exception("File was 'downloaded ok' but file size was zero? ");
        }
        saveTmpFile($tempFilename, $localFilename);
    }

    function getS3RegionOfBucket($bucket)
    {
        $s3 = $this->s3ClientFactory->createClient();
        $response = $s3->getBucketLocation(array(
            'Bucket' => $bucket,
        ));

        return $response->get("Location");
    }
}

