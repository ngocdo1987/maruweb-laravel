<?php


namespace App\Services;

abstract class AbstractEloquentService
{
    protected $model;

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param array $credentials
     * @return mixed
     */
    public function create(array $credentials)
    {
        $model = $this->model->create($credentials);
        return $model;
    }

    /**
     * @param array $credentials
     * @param $id
     * @return mixed
     */
    public function update(array $credentials, $id)
    {
        $model = $this->model->find($id);
        return $model->update($credentials);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    //abstract function search($query);

    // Upload image
    public function uploadImage($image, $folder = '', array $extend = array(), $resize = true, $type = '')
    {
        $code = 1;
        $data = [];
        if (!empty($image)) {
            $folderName = date('Y/m');
            $fileNameWithTimestamp = md5($image->getClientOriginalName() . time()) . rand(10, 100);
            $fileName = $fileNameWithTimestamp . '.' . $image->getClientOriginalExtension();
            if (!$extend) {
                $extend = ['png', 'jpg', 'jpeg', 'pdf', 'gif'];
            }
            if (!in_array(strtolower($image->getClientOriginalExtension()), $extend)) {
                $data['code'] = 0;
                return $data;
            }
            if (!file_exists('../public_html/'.$folder . '/' . $folderName)) {
                mkdir('../public_html/'.$folder . '/' . $folderName, 0755, true);
            }

            $imageName = '/' . $folder . '/' . $folderName . '/' . $fileName;
            $image->move('../public_html/'.$folder . '/' . $folderName, $fileName);

            $data = [
                'name' => $imageName,
                'code' => $code,
                'path_img' => $_SERVER['DOCUMENT_ROOT'] . $imageName,
            ];

            if ($resize) {
                resizeImage($folder . '/' . $folderName, $fileName, $fileNameWithTimestamp, $image);
            }
            return $data;
        }
        return $data['code'] = 0;
    }
}
