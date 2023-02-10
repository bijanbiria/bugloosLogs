<?php

namespace App\Repositories;

use App\Models\Logs;
use Illuminate\Support\Facades\File;
use Throwable;

class ImportLogsFromFileRepository extends BaseRepository
{
    public function import( $filePath )
    {
        // check file exist
        if ( !file_exists( $filePath ) ) {
            return "no such file in the directory";
        }

        try {
            // read file and insert every row in loop
            File::lines( $filePath ) -> each( function( $line, $fileRowNumber ) {
                // explode every line by free space and map to remove some chars
                $dataArray = array_map( [
                    $this,
                    '_removeSpecialChars'
                ], explode( " ", $line ) );

                try {
                    // save seperated data in db, without duplicate
                    Logs ::query() -> create( [
                        'service_name'    => $dataArray[ 0 ],
                        'date_time'       => $dataArray[ 2 ],
                        'rest_type'       => $dataArray[ 3 ],
                        'route'           => $dataArray[ 4 ],
                        'http_version'    => $dataArray[ 5 ],
                        'status_code'     => $dataArray[ 6 ],
                        'file_row_number' => $fileRowNumber
                    ] );
                } catch ( \Illuminate\Database\QueryException $exception ) {
                    return $exception->errorInfo;
                }
            } );
        } catch ( Throwable $e ) {
            return $e;
        }

        return "Selected File imported Successfully";
    }


    /*
     * Remove all unnecessary characters
     */
    private function _removeSpecialChars( $string )
    {
        return preg_replace( '/[^^a-zA-Z0-9:.!@\/\- ]/', '', $string );
    }
}
