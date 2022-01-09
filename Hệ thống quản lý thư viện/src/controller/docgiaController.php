<?php

require_once 'model/docgiaModel.php';
class docgiaController{
    function index(){
        $bdModal = new docgiaModal();
        $bdonor = $bdModal->getAllBD();
        require_once 'view/docgia/index.php';
    }
    function admin(){
        $bdModal = new docgiaModal();
        $bdonor = $bdModal->getAllBD();
        require_once 'view/docgia/admin.php';
    }
    function add(){
        $error = '';
        if(isset($_POST['submit'])){
            $hovaten = $_POST['hovaten'];
            $gioitinh = $_POST['gioitinh'];
            $namsinh = $_POST['namsinh'];
            $nghenghiep = $_POST['nghenghiep'];
            $ngaycapthe = $_POST['ngaycapthe'];
            $ngayhethan = $_POST['ngayhethan'];
            $diachi = $_POST['diachi'];
            if(empty($hovaten) ||  empty($gioitinh) || empty($namsinh) || empty($nghenghiep)|| empty($ngaycapthe)|| empty($ngayhethan)|| empty($diachi)){
                $error = 'Thông tin chưa đầy đủ!';
            }else{
                $bdModal = new docgiaModal();
                $bdArr = [
                    'hovaten' => $hovaten,
                    'gioitinh' => $gioitinh,
                    'namsinh' => $namsinh,
                    'nghenghiep' => $nghenghiep,
                    'ngaycapthe' => $ngaycapthe,
                    'ngayhethan' => $ngayhethan,
                    'diachi' => $diachi,



                ];
                $isAdd = $bdModal->insert($bdArr);
                if ($isAdd) {
                    $TT=  "Thêm mới thành công";
                }
                else {
                    $TT= "Thêm mới thất bại";
                }
                header("Location: index.php?controller=docgia&action=admin&tt=$TT");
                exit();
            }

        }
        require_once 'view/docgia/add.php';
    }
    function edit(){
        if (!isset($_GET['madg'])) {
            $_SESSION['error'] = "Tham số không hợp lệ";
            header("Location: index.php?controller=docgia&action=admin");
            return;
        }
        if (!is_numeric($_GET['madg'])) {
            $_SESSION['error'] = "Id phải là số";
            header("Location: index.php?controller=docgia&action=admin");
            return;
        }
        $id = $_GET['madg'];
        $bdModal = new Modal();
        $BD = $bdModal->getBDById($id);
        $error = '';
        if (isset($_POST['submit'])) {
            $hovaten = $_POST['hovaten'];
            $gioitinh = $_POST['gioitinh'];
            $namsinh = $_POST['namsinh'];
            $nghenghiep = $_POST['nghenghiep'];
            $ngaycapthe = $_POST['ngaycapthe'];
            $ngayhethan = $_POST['ngayhethan'];
            $diachi = $_POST['diachi'];
            if(empty($hovaten) ||  empty($gioitinh) || empty($namsinh) || empty($nghenghiep)|| empty($ngaycapthe)|| empty($ngayhethan)|| empty($diachi)){
                $error = 'Thông tin chưa đầy đủ!';
            }
            else {
                $bdArr = [
                    'hovaten' => $hovaten,
                    'gioitinh' => $gioitinh,
                    'namsinh' => $namsinh,
                    'nghenghiep' => $nghenghiep,
                    'ngaycapthe' => $ngaycapthe,
                    'ngayhethan' => $ngayhethan,
                    'diachi' => $diachi,
                ];
                $isAdd = $bdModal->update($bdArr);
                if ($isAdd) {
                    $TT=  "Sửa thành công";
                }
                else {
                    $TT= "Sửa thất bại";
                }
                header("Location: index.php?controller=docgia&action=admin&tt=$TT");
                exit();
            }
        }
        require_once 'view/docgia/edit.php';
    }
    function delete(){
        $id = $_GET['madg'];
        if (!is_numeric($id)) {
            header("Location: index.php?controller=docgia&action=index");
            exit();
        }
        $bdModal = new docgiaModal();
        $isDelete = $bdModal->delete($id);
        if ($isDelete) {
            //chuyển hướng về trang liệt kê danh sách
            //tạo session thông báo mesage
            $TT=  "Xóa bản ghi thành công";
        }
        else {
            //báo lỗi
            $TT = "Xóa bản ghi thất bại";
        }
        header("Location: index.php?controller=docgia&action=admin&tt=$TT");
        exit();
    }
}

