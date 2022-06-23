<?php

function card_top($card_name)
{

    echo " 
        <div class='listing-card__info--top'>
        <strong class='listing-card__name'> $card_name > </strong>
            <span>
                <button class='btn' type='reset' >취소</button>
                <button class='btn' type='submit' >등록</button>
            </span>
        </div>
        <div> &nbsp </div>";
}
function weeks($week_value, $week_id, $sales_day_arr)
{
    $i = 0;
    $week = "";
    $weeks_style = "";
    $check = "";

    for ($i = 0; $i < 7; $i++) {
        if (isset($sales_day_arr[$i])) {
            if ($sales_day_arr[$i] == $week_value[$i]) {
                $weeks_style = " active";
                $check = "checked='checked'";
            } else {
                $weeks_style = "";
                $check = "";
            }
        }
        $week .= "<input id='$week_id[$i]' type='checkbox' name='$week_id[$i]' value='$week_value[$i]' $check hidden>
        <label class='listing-card__info__week$weeks_style' for='$week_id[$i]'>$week_value[$i]</label>";
    }
    echo $week;
}

function sales_time_open_hour()
{
    $hour = "";
    $i = 0;
    $hour .= "<select name='sales_open_hour'><option value=''>--- 시간 ---</option>";
    for ($i; $i < 24; $i++) {
        if ($i < 10) {
            $hour .= "<option value='0$i:'>0$i 시</option>";
        } else {
            $hour .= "<option value='$i:'>$i 시</option>";
        }
    }
    $hour .= "</select>";
    echo $hour;
}

function sales_time_open_minute()
{
    $minute = "";
    $i = 0;
    $minute .= "<select name='sales_open_minute'><option value=''>--- 분 ---</option>";
    for ($i; $i < 60; $i += 10) {
        if ($i < 10) {
            $minute .= "<option value='0$i'>0$i 분</option>";
        } else {
            $minute .= "<option value='$i'>$i 분</option>";
        }
    }
    $minute .= "</select>";
    echo $minute;
}

function sales_time_close_hour()
{
    $hour = "";
    $i = 0;
    $hour .= "<select name='sales_close_hour'><option value=''>--- 시간 ---</option>";
    for ($i; $i < 24; $i++) {
        if ($i < 10) {
            $hour .= "<option value='0$i:'>0$i 시</option>";
        } else {
            $hour .= "<option value='$i:'>$i 시</option>";
        }
    }
    $hour .= "</select>";
    echo $hour;
}

function sales_time_close_minute()
{
    $minute = "";
    $i = 0;
    $minute .= "<select name='sales_close_minute'><option value=''>--- 분 ---</option>";
    for ($i; $i < 60; $i += 10) {
        if ($i < 10) {
            $minute .= "<option value='0$i'>0$i 분</option>";
        } else {
            $minute .= "<option value='$i'>$i 분</option>";
        }
    }
    $minute .= "</select>";
    echo $minute;
}

function menu_category_input($menu_cate)
{
    $menu_category = "";
    $i = 0;
    $menu_category .= "<select name='menu_category'><option value=''>-- 카테고리 --</option>";
    for ($i; $i < count($menu_cate); $i++) {
        $menu_category .= "<option value='$menu_cate[$i]'>$menu_cate[$i]</option>";
    }

    $menu_category .= "</select>";
    echo $menu_category;
}

function menu_category_edit($store_menu_cate)
{
    $menu_cate = [
        "한식",
        "분식",
        "패스트푸드",
        "도시락",
        "중식",
        "양식",
        "일식",
        "커피/디저트",
        "네일샵",
        "헤어샵",
        "취미",
        "운동"
    ];
    $menu_category = "";
    $i = 0;
    $menu_category .= "<select name='menu_category'><option value='$store_menu_cate'>-- $store_menu_cate --</option>";
    for ($i; $i < count($menu_cate); $i++) {
        $menu_category .= "<option value='$menu_cate[$i]'>$menu_cate[$i]</option>";
    }

    $menu_category .= "</select>";
    echo $menu_category;
}


function sales_count()
{
    $count = "";
    $i = 1;
    $count .= "<select name='sales_count'><option value=''>-- 구독 이용 --</option>";
    for ($i; $i <= 30; $i++) {
        $count .= "<option value='$i'>$i</option>";
    }

    $count .= "</select>";
    echo $count;
}

function sales_count_edit($subed_count)
{
    $count = "";
    $i = 1;
    $count .= "<select name='sales_count'><option value='$subed_count'>-- $subed_count --</option>";
    for ($i; $i <= 30; $i++) {
        $count .= "<option value='$i'>$i</option>";
    }

    $count .= "</select>";
    echo $count;
}


function menu_count_cd($menu_count_cd)
{
    $menu_cd = "";
    $i = 0;
    $menu_cd .= "<select name='menu_cd'><option value=''>-- 단위 --</option>";
    for ($i; $i < count($menu_count_cd); $i++) {
        $value = $i + 1;
        $menu_cd .= "<option value='$value'>$menu_count_cd[$i]</option>";
    }

    $menu_cd .= "</select>";
    echo $menu_cd;
}

function menu_count_cd_edit($cd_unit)
{
    $menu_count_cd = [
        "회",
        "개"
    ];
    $cd_calc = $cd_unit - 1;
    $menu_cd = "";
    $i = 0;
    $menu_cd .= "<select name='menu_cd'><option value='$cd_unit'>-- $menu_count_cd[$cd_calc] --</option>";
    for ($i; $i < count($menu_count_cd); $i++) {
        $value = $i + 1;
        $menu_cd .= "<option value='$value'>$menu_count_cd[$i]</option>";
    }

    $menu_cd .= "</select>";
    echo $menu_cd;
}

function 로그아웃($login_email)
{
    if (isset($login_email)) {
        echo "
    <a href='store_logout.php'>
    <i class='bx bx-log-out icon'></i>    
    <span class='text nav-text'>로그아웃</span>
    </a>
    ";
    }
}

function 상단문구($store_name)
{
    echo "<div class=''>
            <div class='main__header'>
                <h2 class='main__title'> $store_name 사장님,<div><br>입금 예정금액은 <strong>210,000</strong>원입니다.</div></h2>
            </div>
        </div>";
}

function 공지($card_name6, $store_notice)
{
    echo "<form class = 'listing-card__form' id ='store_notice' action='store_main_notice.php' method='post'>
    <div class='listing-card__notice'>";
    card_top($card_name6);
    echo "<div>
    <textarea name='store_notice' placeholder='공지사항을 입력하세요'> $store_notice";
    echo "</textarea>
    </div>
    
    </div>
    </form>";
}

function 가게소개($card_name1, $store_info)
{
    echo "<form class='listing-card__form' id='store_info' action='store_main_intro.php' method='post'>
    <div class='listing-card__info'>";
    card_top($card_name1);
    echo "<div>
    <textarea name='store_intro' placeholder='가게를 소개하세요'> $store_info </textarea>
</div>
</div>
</form>";
}

function 가게이미지($card_name3, $store_name)
{
    // echo "<form class='img_test' id='store_img' action='store_photo.php' method='post' enctype='multipart/form-data'>
    //     <div class='listing-card__img'>";
    echo "<form class='img_test image-form' id='store_img' action='store_photo.php' method='post' enctype='multipart/form-data'>";
    card_top($card_name3);
    $error_img = 'this.src="https://cdn.pixabay.com/photo/2020/04/17/19/48/city-5056657_960_720.png"';
    // echo "<div class='image-input'>
    //       <div class='image-input__input-wrapper' id='inputWrapper'><label><input type='file' id='imageInput'  name='img' accept='image/*'></label></div>
    //                         <div class='image-input__pseudo'>
    //                         <div><i class='fa-solid fa-plus'></i></div>
    //                         <div>이미지 넣기</div>
    //                         </div>";
    echo "<div class='image-input'>
    <div class='image-input__input-wrapper' id='inputWrapper'><input type='file' id='imageInput' name='img' accept='image/*' class='ui-input image-input__input' tabindex='0'>
        <div class='image-input__pseudo'>
            <div><i class='fa-solid fa-plus'></i></div>
            <div>이미지 넣기</div>
        </div>";
    $session_img = $_SESSION['login_store']['store_photo'];
    $store_img = $session_img == null ? 'https://cdn.pixabay.com/photo/2020/04/17/19/48/city-5056657_960_720.png' : '../img/store/' . $store_name . '/Main_img/' . $session_img;
    //     echo "<div class='store__img'>                                    
    //     <img src='$store_img' onerror= '$error_img'>
    // </div>
    // </div>
    // </div>
    // </form>"
    echo "
        </div>
    </div>
    <div class='store__img'>
        <img src='$store_img' onerror='$error_img'>
    </div>
</form>
";
}
function 영업요일($card_name2, $week_value, $week_id, $sales_day_arr)
{
    echo "<form id='store_week' action='sales_day_proc.php' method='post'>
                            
    <div class='listing-card__week'>";
    card_top($card_name2);
    echo "</div>
    
    <div class='listing-card__ctnt' name='sale_day'>";
    weeks($week_value, $week_id, $sales_day_arr);
    echo " </div></form>";
}

function 영업시간($card_name4, $sales_time_arr)
{
    echo "<form id='store_time' action='store_main_sales_time.php' method='post'>
                        <div class='listing-card__info'>";
    card_top($card_name4);
    echo "<div> <h3>오픈 시간 $sales_time_arr[0] </h3>";
    sales_time_open_hour();
    sales_time_open_minute();
    echo "</div><div><h3>마감 시간 $sales_time_arr[1]</h3>";
    sales_time_close_hour();
    sales_time_close_minute();
    echo "</div> </div> </form>";
}

function 메뉴등록($card_name7, $menu_cate, $menu_count_cd)
{
    echo "<form id='store_menu_input' action='store_menu_input.php' method='post' enctype='multipart/form-data'>
    <div class='listing-card__info'>";
    card_top($card_name7);
    echo "<div>메뉴 카테고리</div><div>";
    menu_category_input($menu_cate);
    echo "</div> <div>메뉴명</div>
        <div><input type='text' name='menu_nm' placeholder='메뉴명을 입력하세요' id=''>
    </div>
    <div>메뉴 소개</div>
        <div><textarea name='menu_intro' id='' cols='30' rows='10' placeholder='메뉴를 소개하세요'></textarea>
    </div>
    <div class='store_img_input'> 메뉴 이미지</div>
        <div><label class=''>
            <input class='' type='file' name='menu_img' accept='image/*' >
        </label>
    </div>
    <div>메뉴 정가</div>
    <div><input type='number' name='price' id='' step='500' placeholder='구독할인전 가격' ></div>
    <div>구독 할인가</div>
    <div><input type='number' name='sub_price' id='' step='500' placeholder='구독할인 가격'></div>
    <div>월 총 횟수</div>
    <div>";
    sales_count();
    menu_count_cd($menu_count_cd);
    echo "</div> </div> </form>";
}


function 메뉴편집($menu_num, $menu_nm, $menu_intro, $price, $subed_price, $store_menu_cate, $subed_count, $cd_unit)
{
    echo "<div class='listing-card__info' >
        <div class='listing-card__info--top'>
        <strong class='listing-card__name'>   </strong>
        <input name='menu_num' type='text' value='$menu_num' hidden>
            <span>
                <button class='btn' type='reset' >취소</button>
                <button class='btn' type='submit' >수정</button>
            </span>
        </div>
        <div> &nbsp </div>
        <div>메뉴 카테고리</div><div>";
    menu_category_edit($store_menu_cate);
    echo "</div> <div>메뉴명</div>  
        <div><input type='text' name='menu_nm' placeholder='메뉴명을 입력하세요' value='$menu_nm'>
    </div>
    <div>메뉴 소개</div>
        <div><textarea name='menu_intro' id='' cols='30' rows='10' placeholder='메뉴를 소개하세요'>$menu_intro</textarea>
    </div>
    <div class='store_img_input'> 메뉴 이미지</div>
        <div><label class=''>
            <input class='' type='file' name='menu_img_edit' accept='image/*' >
        </label>
    </div>
    <div>메뉴 정가</div>
    <div><input type='number' name='price' id='' step='500' placeholder='구독할인전 가격' value='$price'></div>
    <div>구독 할인가</div>
    <div><input type='number' name='sub_price' id='' step='500' placeholder='구독할인 가격' value='$subed_price'></div>
    <div>월 총 횟수</div>
    <div>";
    sales_count_edit($subed_count);
    menu_count_cd_edit($cd_unit);
    echo "</div> </div>";
}
