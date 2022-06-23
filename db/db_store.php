<?php

    include_once "db.php";

    // 회원가입 함수, 수정필요
    function create_store(&$param) {

        $store_mail = $param['store_email'];
        $store_pw = $param['store_pw'];
        $store_check_pw = $param['store_check_pw'];
        $nickname = $param['nickname'];
        $store_nm = $param['store_nm'];
        
        $sql = "INSERT INTO t_store
        (store_email,store_pw,nickname,store_nm)
        value
        ('$store_mail','$store_pw','$nickname','$store_nm')
        ";
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            return $result;
        }
        // ID체크, 사장님들은 이메일로
        function id_check(&$param)
        {
            $store_email = $param['store_email'];
        
            $sql = "SELECT store_email 
                    from t_store
                    where store_email = '$store_email' 
            ";
            $conn = get_conn();
            $row = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($row);
            mysqli_close($conn); 
            if(isset($result['store_email']))
            {
            return true;
            }
            return false;
        }
        // 로그인 세션값, 그냥 필요한 셀렉트 문 있을 때마다 씀. 추후 구분필요
        function login_store(&$param){
        
            $store_email = $param['store_email'];
    
                $sql = 
                "   SELECT A.*, B.menu_photo 
                    from t_store A
                    INNER JOIN t_menu B
                    ON A.store_num = B.store_num
                    where store_email = '$store_email'
            ";
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            return $row;
        }
        // 가게 사진 업로드
        function upd_store_photo(&$param) {
            $sql = "UPDATE t_store
                       SET store_photo = '{$param["store_photo"]}' 
                     WHERE store_email = '{$param["store_email"]}'";
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            return $result;
         }

         // 영업요일 등록/수정
        function sales_day(&$param){
            $mon = $param['mon'];
            $tue = $param['tue'];
            $wed = $param['wed'];
            $thu = $param['thu'];
            $fri = $param['fri'];
            $sat = $param['sat'];
            $sun = $param['sun'];
            
            $sql = 
            "   UPDATE t_store
                SET sales_day = '$mon $tue $wed $thu $fri $sat $sun'
                WHERE store_email = 'test@naver.com'
        
            ";
            $conn = get_conn();
        
            $result = mysqli_query($conn, $sql);
            return $result;
            
        }
        // 영업 시간 등록
        function store_time_insert(&$param){
            $store_email = $param['store_email'];
            $sales_time = $param['sales_time'];
    
            $store_open_hour = $_POST['sales_open_hour'];           
            $store_open_minute = $_POST['sales_open_minute'];           
            $store_close_hour = $_POST['sales_close_hour'];           
            $store_close_minute = $_POST['sales_close_minute'];      
            if(!isset($sales_time))  {
                $sql = 
            "   INSERT INTO t_store
                (sales_time)
                VALUE
                ('$store_open_hour$store_open_minute,$store_close_hour$store_close_minute')
                where store_email = '$store_email'
            ";
            }
            else{
                $sql = 
            "   UPDATE t_store
                SET sales_time = '$store_open_hour$store_open_minute,$store_close_hour$store_close_minute'
                where store_email = '$store_email'
            ";
            }
            
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);   
            
            mysqli_close($conn);   
            return $result; 
        }
        //공지사항 등록
        function store_notice_insert(&$param){
            $store_notice = $_POST['store_notice'];
            $store_email = $param['store_email'];
            if(!isset($store_notice))  {
                $sql = 
            "   INSERT INTO t_store
                (store_notice)
                VALUE
                ('$store_notice')
                where store_email = '$store_email'
            ";
            }
            else{
                $sql = 
            "   UPDATE t_store
                SET store_notice = '$store_notice'
                where store_email = '$store_email'
            ";
            }
            
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);   
            
            mysqli_close($conn);   
            return $result; 
    }
    // 해당 가게 메뉴 선택
    function store_menu_select(&$param){
        $store_num = $param['store_num'];
    
                $sql = 
                "   SELECT *
                    from t_menu
                    where store_num = '$store_num'
            ";
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            return $row;
    }

    // 가게 메뉴 등록
    function store_menu_input(&$param){
        $category = $param['menu_category'];
        $menu_nm = $param['menu_nm'];
        $menu_intro = $param['menu_intro'];
        $menu_photo = $param['menu_photo'];
        $sales_count = $param['sales_count'];
        $price = $param['price'];
        $sub_price = $param['sub_price'];        
        $store_num = $param['store_num'];
        $cd_unit = $param['menu_cd'];


        $sql =
        "   INSERT INTO t_menu
            (store_num, menu_cate, menu_nm, price, subed_price, subed_count, menu_intro, menu_photo, cd_unit)
            VALUE
            ('$store_num','$category','$menu_nm','$price', '$sub_price', '$sales_count','$menu_intro','$menu_photo', $cd_unit)
            

        ";

        
        $conn = get_conn();
        $result = mysqli_query($conn, $sql);   
        
        mysqli_close($conn);   
        return $result; 
}
// 가게 메뉴 편집
function store_menu_edit(&$param){
    $category = $param['menu_category'];
    $menu_nm = $param['menu_nm'];
    $menu_intro = $param['menu_intro'];
    $menu_photo = $param['menu_photo'];
    $sales_count = $param['sales_count'];
    $price = $param['price'];
    $sub_price = $param['sub_price'];        
    $store_num = $param['store_num'];
    $cd_unit = $param['menu_cd'];
    $menu_num = $param['menu_num'];


    $sql =
    "   UPDATE t_menu
        SET store_num ='$store_num', menu_cate ='$category', menu_nm='$menu_nm', price='$price', 
        subed_price='$sub_price', subed_count='$sales_count', menu_intro='$menu_intro', menu_photo='$menu_photo', cd_unit='$cd_unit'
        WHERE menu_num = $menu_num
        

    ";

    
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);   
    
    mysqli_close($conn);  
    echo $sql; 
    return $result; 
}

// 메뉴 편집
function menu_edit(&$param){
    $store_num = $param['store_num'];    
    $sql = 
    "   SELECT * FROM t_menu
        WHERE store_num = $store_num

    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    
    mysqli_close($conn);
    return $result;
}

// 등록될 메뉴넘버 받아오기
function menu_num_load(){
    $sql = 
    "   SELECT MAX(menu_num) FROM t_menu
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}
function menu_num_load_edit(){
    $sql = 
    "   SELECT menu_num FROM t_menu
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

// 예약현황 불러오기

function reserve_menu(&$store_num){    
    $sql = 
    "   SELECT *
        FROM t_sub A
        INNER JOIN t_usedsub B
        ON A.sub_num = B.sub_num
        WHERE A.store_num = $store_num
        AND B.cd_sub_status = 0

    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function reserve_menu2($menu_num){
    $sql = 
    "   SELECT menu_nm FROM t_menu
        WHERE menu_num = $menu_num
    ";
    $conn = get_conn();
    $row = mysqli_query($conn, $sql);
    foreach($row as $val){
        $result = $val['menu_nm'];
    }
    mysqli_close($conn);
    return $result;
}

function reserve_menu3($user_num){
    $sql = 
    "   SELECT user_nm FROM t_user
        WHERE user_num = $user_num
    ";
    $conn = get_conn();
    $row = mysqli_query($conn, $sql);
    foreach($row as $val){
        $result = $val['user_nm'];
    }
    mysqli_close($conn);
    return $result;
}

function reserve_menu4($menu_num){
    $sql = 
    "   SELECT cd_unit FROM t_menu
        WHERE menu_num = $menu_num
    ";
    $conn = get_conn();
    $row = mysqli_query($conn, $sql);
    foreach($row as $val){
        $result = $val['cd_unit'];
    }
    mysqli_close($conn);
    return $result;
}

function accept($sub_num){
    $sql = 
    "   UPDATE t_usedsub
        SET cd_sub_status = 1
        where sub_num = $sub_num
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);    
    mysqli_close($conn);
    return $result;
}