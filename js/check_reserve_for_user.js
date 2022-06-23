function check_reserve_for_user(user_num) {
  setInterval(function () {
    //인터벌로 실행될 코드
    fetch(`../json_now_reservation_for_user.php?${user_num}`)
      .then((response) => {
        return response.json();
      })
      .then((nowRes) => {
        // if (nowRow)
        whenNewReservation(nowRes);
        // alert("알림");
      });
  }, 5000);
}

function whenNewReservation(nowRes) {
  console.log(nowRes);
}

check_reserve(1);

// 유저에게 어느경우에 알람이 필요한지 체크후 체계적으로 ㄱㄱ
