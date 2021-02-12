<?php


namespace App\Services;

use App\Models\Seminar;

class SeminarsService extends AbstractEloquentService
{
    const STATUS = 1;
    public function __construct(Seminar $model)
    {
        $this->model = $model;
    }

    public function search($query)
    {
        // TODO: Implement search() method.
    }
    
    public function searchAdvanced($request)
    {
        $seminars = Seminar::orderBy('created_at', 'DESC');

        if ($request->name) {
            $seminars->where('name', 'like', '%'.$request->name.'%');
        }
        if (isset($request->type)) {
            if ($request->type != 0 && ($request->type == 1 || $request->type == 2 || $request->type == 3 || $request->type == 4)) {
                $seminars->where('type', $request->type);
            }
        }
        if ($request->date_from_created && $request->date_end_created) {
            $seminars->whereDate('created_at', '>=', $request->date_from_created)
            ->whereDate('created_at', '<=', $request->date_end_created);
        }
        if ($request->date_from_created) {
            $seminars->whereDate('created_at', '>=', $request->date_from_created);
        }
        if ($request->date_end_created) {
            $seminars->whereDate('created_at', '<=', $request->date_end_created);
        }

        return $seminars = $seminars->paginate(config('constants.seminar.per_page_back'));
    }

    public function storeSeminar($request)
    {
        $data = $request->all();
        $remove = ['page', '_token', 'is_change', '_method'];
        $data = removeKeyArr($data, $remove);
        $data['time_start']                 =   date("H:i", strtotime($data['time_start']));
        $data['time_end']                   =   date("H:i", strtotime($data['time_end']));
        $data['total_participants']         =   $data['total_participants_start'] + $data['total_participants_end'];
        $data['start_event_date']           =   date_format(date_create($data['start_event_date']), "Y/m/d H:i:s");
        $seminar = $this->model->create($data);
        
        return $seminar->id;
    }
 
    public function updateSeminar($request)
    {
        $data = $request->all();
        $remove = ['page', '_token', 'is_change', '_method', 'old_start_event_date'];
        $data = removeKeyArr($data, $remove);
        $seminar = Seminar::findOrFail($data['id']);
        $data['time_start']                 =   date("H:i", strtotime($data['time_start'])).':00';
        $data['time_end']                   =   date("H:i", strtotime($data['time_end'])).':00';
        $data['total_participants'] = $data['total_participants_start'] + $data['total_participants_end'];
        $data['start_event_date'] = date_format(date_create($data['start_event_date']), "Y-m-d H:i:s");
      
        return $seminar->update($data);
    }

    public function getSeminars()
    {
        $seminars = $this->model::where('status', self::STATUS)
            ->orderBy('created_at', 'DESC')
            ->paginate(config('constants.seminar.per_page_front'));
            
        return [
            'seminars' => $seminars,
        ];
    }

    public function showSeminar($id)
    {
        $seminar = $this->model::findOrFail($id);

        $previous = $this->model::where('status', self::STATUS)
            ->where('created_at', '<=', $seminar->created_at)
            ->where('id', '!=', $seminar->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $next = $this->model::where('status', self::STATUS)
            ->where('created_at', '>=', $seminar->created_at)
            ->where('id', '!=', $seminar->id)
            ->orderBy('created_at', 'asc')
            ->first();

        $title = $seminar->seo_title !=null ? $seminar->seo_title : $seminar->name;
        $seo_description = $seminar->description !=null ? $seminar->description : "";
        $seo_keyword = $seminar->keyword !=null ? $seminar->keyword.',リファイニング建築・都市再生協会, リファイニング ,都市再生,一般社団法人' : "リファイニング建築・都市再生協会, リファイニング ,都市再生,一般社団法人";
        $h1_title = $seminar->h1 !=null ? $seminar->h1 : '既存建物の長寿命化・適法化するリファイニング建築（再生建築）を普及し社会に貢献します';
        
        return [
            'seminar' => $seminar,
            'previous' => $previous,
            'next' => $next,
            'title' => $title,
            'seo_description' => $seo_description,
            'seo_keyword' => $seo_keyword,
            'h1_title' => $h1_title,
        ];
    }

    public function getSeminar()
    {
        return Seminar::where('status', self::STATUS)->limit(config('constants.home.per_page_front'))->orderBy('created_at', 'DESC')->get();
    }
}
