<?php

namespace App\Http\Controllers;

use App\Classes\ExportService;
use App\ContestPeriod;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class AdminController extends Controller
{
    /**
     * @var ExportService
     */
    private $exportService;

    /**
     * AdminController constructor.
     *
     * @param ExportService $exportService
     */
    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }
    
    /**
     * @param $selectedPeriod
     * @param Request $request
     * @return mixed
     */
    public function getEntries($selectedPeriod, Request $request)
    {
        $sort = $request->has('sort') ? $request->get('sort') : 'date';
        $order = $request->has('order') ? $request->get('order') : 'desc';
        $periods = ContestPeriod::getCurrentAndPreviousPeriods();

        $photos = Photo::getEntriesFromPeriodSortedBy($selectedPeriod, $sort, $order, 10);

        $data = compact(
            'photos',
            'periods',
            'selectedPeriod',
            'sort',
            'order'
        );

        return view('admin.entries', $data);
    }

    /**
     * @param $id
     * @param Request $request
     * @return array
     */
    public function deletePhoto($id, Request $request)
    {
        try {
            $photo = Photo::findOrFail($id);
            $photo->delete();

            $data = [
                'type' => 'success',
                'code' => '200',
                'messages' => [
                    'Photo deleted successfully.',
                ],
                'photo_id' => $photo->id,
            ];
        } catch (\Exception $e) {
            $data = [
                'type' => 'error',
                'code' => '500',
                'messages' => [
                    'Something went wrong. Photo is not deleted.',
                ],
            ];
        }

        return $data;
    }

    /**
     * @param $id
     * @param Request $request
     * @return array
     */
    public function disqualifyUser($id, Request $request)
    {
        try {
            $user = User::findOrFail($id);
            $photos = $user->photos;

            \DB::transaction(function () use ($user, $photos) {
                $user->delete();
                foreach ($photos as $photo) {
                    $photo->delete();
                }
            });


            $data = [
                'type' => 'success',
                'code' => '200',
                'messages' => [
                    'User disqualified successfully.',
                ],
                'user_id' => $user->id,
            ];
        } catch (\Exception $e) {
            $data = [
                'type' => 'error',
                'code' => '500',
                'messages' => [
                    'Something went wrong. User is not disqualified.',
                ],
            ];
        }

        return $data;
    }

    /**
     * @param $period
     * @return mixed
     */
    public function exportPeriod($period)
    {
        $photos = Photo::getEntriesFromPeriodForExport($period);

        return $this->exportService->createEntriesExcelExport($photos, 'Exports from period ' . $period . ' - TNF wedstrijd')->export('xls');
    }

    /**
     * @return mixed
     */
    public function exportAll()
    {
        $photos = Photo::orderBy('created_at', 'ASC')->get();

        return $this->exportService->createEntriesExcelExport($photos, 'All entries - TNF wedstrijd')->export('xls');
    }
}
