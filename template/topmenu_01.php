<nav class="sidebar sidebar-offcanvas" id="sidebar" style=" box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); background-color: #303030;  ">
    <ul class="nav">
        <li class="nav-item nav-profile" >
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="../images/faces-clipart/pic-1.png" alt="profile image" style = "height:100%;width: 100%  !important; ">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name" s=><?php echo $userRow["user_name"]; ?></p>
                        <div>
                            <small class="designation text-muted">
                                <?php
                                // echo $userRow["user_class"];
                                if ($userRow["user_class"] == 1) {
                                    echo "user";
                                } else {
                                    echo "admin";
                                }
                                ?>
                            </small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">เพิ่มใบแจ้งซ่อม
                    <i class="mdi mdi-plus"></i>
                </button>
                <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#outstockink">เบิกหมึกปริ้นเตอร์
                    <i class="mdi mdi-plus"></i>
                </button>
                <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#outstockacc">เบิกอุปกรณ์ IT
                    <i class="mdi mdi-plus"></i>
                </button>
            </div>
        </li> 
        <?php
        if ($userRow["user_class"] == 2) {
            $query = "SELECT * FROM menu WHERE menu_type = 2 OR menu_type = 1 ORDER BY menu_id DESC";
        } else {
            $query = "SELECT * FROM menu WHERE menu_type = 1 ORDER BY menu_id DESC";
        }
        $querymenu = $user->menu($query);
        ?>
    </ul>
</nav>