

<div class="row">
    <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Thêm loại sách mới</h1>
    </div>
    <!--end page header -->
</div>

<?php

if(isset($_POST['ten_loai_sach'])){
    $ten_loai_sach = $_POST['ten_loai_sach'];
    $id_loai_cha = $_POST['id_loai_cha'];
    $trang_thai = (isset($_POST['trang_thai']))?1:0;

    $xl_loai_sach->them_loai_sach_moi($ten_loai_sach, $id_loai_cha, $trang_thai);
    if($result !== false){
        ?>
        <script>
            alert('thêm loại sách mới thành công');
            window.location.href = '?page=' + '<?php echo $_GET['page'] ?>';
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert('thêm loại sách mới thất bại, vui lòng kiểm tra và thử lại');
        </script>
        <?php 
    }
}
?>

<?php
    
    $ds_loai_sach_cap_1 = $xl_loai_sach->load_toan_bo_danh_sach_loai_sach(0);

    foreach($ds_loai_sach_cap_1 as $loai_sach_cap_1){
        $ds_loai_sach_cap_2 = $xl_loai_sach->load_toan_bo_danh_sach_loai_sach($loai_sach_cap_1->id);
        $loai_sach_cap_1->ds_loai_con = $ds_loai_sach_cap_2;
    }

    //echo '<pre>',print_r($ds_loai_sach_cap_1),'</pre>';
?>

<div class="row">
    <div class="col-lg-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Basic Form Elements
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>Tên loại</label>
                                <input name="ten_loai_sach" class="form-control">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="form-group">
                                <label>Loại cha</label>
                                <select name="id_loai_cha" id=""  class="form-control">
                                    <option value="0">Không có loại cha</option>
                                    <?php
                                    foreach($ds_loai_sach_cap_1 as $loai_con_cap_1){
                                        ?>
                                        <option value="<?php echo $loai_con_cap_1->id; ?>">
                                            <?php echo $loai_con_cap_1->ten_loai_sach; ?>
                                        </option>
                                        <?php

                                        if(count($loai_con_cap_1->ds_loai_con) > 0){
                                            foreach($loai_con_cap_1->ds_loai_con as $loai_con_cap_2){
                                                ?>
                                                <option value="<?php echo $loai_con_cap_2->id; ?>">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $loai_con_cap_2->ten_loai_sach; ?>
                                                </option>
                                                <?php 
                                            }
                                        }
                                    }
                                    ?>
                                    
                                </select>
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <br/>
                                <label class="switch">
                                    <input name="trang_thai" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <p class="help-block">Example block-level help text here.</p>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Button</button>
                            <button type="reset" class="btn btn-success">Reset Button</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Form Elements -->
    </div>
</div>