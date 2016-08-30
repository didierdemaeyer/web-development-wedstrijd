<?php

namespace App\Classes;

class ExportService
{
    /**
     * @param $photos
     * @param $filename
     * @return mixed
     */
    public function createEntriesExcelExport($photos, $filename)
    {
        $file = \Excel::create($filename, function($excel) use ($photos) {
            $excel->sheet('Data', function($sheet) use ($photos) {

                $sheet->row(1, array(
                    'Uploaded on',
                    '# of likes', 'Name',
                    'Email',
                    'Address',
                    'Postcode',
                    'City',
                    'Country'
                ));

                foreach ($photos as $photo) {
                    $sheet->appendRow(array(
                        $photo->created_at,
                        count($photo->likes),
                        $photo->user->firstname . ' ' . $photo->user->lastname,
                        $photo->user->email,
                        $photo->user->address,
                        $photo->user->postcode,
                        $photo->user->city,
                        $photo->user->country->name,
                    ));
                }
            });

        });

        return $file;
    }
}