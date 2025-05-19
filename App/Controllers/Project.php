<?php 

namespace App\Controllers;
use App\Model\ModelProject;
use App\Model\ModelCustomer;
use Core\BaseController;

class Project extends BaseController
{
    public function Index()
    {
        $ModelProject = new ModelProject();
        $data['projects'] = $ModelProject->getProjects();

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/index', compact('data'));
    }
    public function Add()
    {
        $ModelCustomer = new ModelCustomer();
        $data['customers'] = $ModelCustomer->getCustomers();

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/add', compact('data'));
    }
    public function Edit($id)
    {
        $ModelCustomer = new ModelCustomer();
        $data['customers'] = $ModelCustomer->getCustomers();

        $ModelProject = new ModelProject();
        $data['project'] = $ModelProject->getProject($id);

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/edit', compact('data'));
    }
    public function CreateProject()
    {
        $data = $this->request->post();

        if(!$data['title'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Lütfen proje adını giriniz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        $ModelCustomer = new ModelProject();
        $insert = $ModelCustomer->createProject($data);

        if($insert)
        {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => _link('proje')]);
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
    public function EditProject()
    {
        $data = $this->request->post();

        if(!$data['id'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Müşteri proje bilgisine ulaşamadık lütfen sayfayı yenileyiniz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        if(!$data['title'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Proje adı boş gönderilemez.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        $ModelProject = new ModelProject();
        $insert = $ModelProject->editProject($data);

        if($insert)
        {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => _link('proje')]);
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

    public function removeProject()
    {
        $data = $this->request->post();

        if(!$data['project_id'])
        {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Proje bilgisine ulaşamadık lütfen sayfayı yenileyiniz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }

        $projectsid = $data['project_id'];
        $remove = $this->db->remove("DELETE FROM projects WHERE projects.id = '$projectsid' ");

        if($remove)
        {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'removed' => $data['project_id']]);
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