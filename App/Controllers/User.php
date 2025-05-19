<?php
namespace App\Controllers;

use App\Model\ModelUser;
use Core\BaseController;
use Core\Session;

class User extends BaseController
{

    public function Index()
    {
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        $data['user'] = Session::getAllSession();
        echo $this->view->load('user/index', compact('data'));
    }

    public function EditProfile()
    {
        $post = $this->request->post();

        if(!$post['name'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'İsim boş bırakılamaz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        if(!$post['surname'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Soyisim boş bırakılamaz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        if(!$post['email'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Email boş bırakılamaz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }

        $ModelUser = new ModelUser();
        $update = $ModelUser->editProfile($post);

        if($update)
        {
            Session::setSession('name', $post['name']);
            Session::setSession('surname', $post['surname']);
            Session::setSession('email', $post['email']);
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'Profiliniz güncellendi.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        else
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Beklenmedik bir hata meydana geldi. Lütfen sayfanızı yenileyerek tekrar deneyiniz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }

    public function ChangePassword()
    {
        $post = $this->request->post();

        if(!$post['password'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Eski Şifrenizi Girmeniz gerekmektedir.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        if(!$post['new_password'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Şifre alanı boş bırakılamaz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        if(!$post['new_password_again'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Şifre tekrar alanı boş bırakılamaz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        if(strlen($post['new_password']) < 6)
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'En az 6 karakterlik tahmin edilmesi zor bir şifre belirleyiniz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        if($post['new_password'] != $post['new_password_again'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Şifreleriniz birbiri ile uyuşmuyor.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }

        $ModelUser = new ModelUser();
        $update = $ModelUser->changePassword($post);

        if($update)
        {
            Session::setSession('password', md5($post['new_password']));

            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'Profiliniz güncellendi.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        else
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Beklenmedik bir hata meydana geldi. Lütfen sayfanızı yenileyerek tekrar deneyiniz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }
}

?>