<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Members</h1>
    <p class="mb-4">Members are people who have registered into the system of TokoBajuMasCitra</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 30px;">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th style="width: 70px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // if ($user['role_id'] == 2) {
                            $no = 1;
                            foreach ($member as $s) {
                                echo " 
                       
                            <tr>
                                <td>$no</td>
                                <td>$s[name]</td>
                                <td>$s[email]</td>
                                <td>
                                    <a type='button' class='badge badge-success' href='" . base_url() . "admin/detail_member/$s[id]'>detail</span></a>
                                    
                                </td>
                            </tr>
                        
                            ";
                                $no++;
                            }
                        // }   
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->