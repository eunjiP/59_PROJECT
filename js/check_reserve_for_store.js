function check_reserve_for_store(store_num) {
  if (store_num == 0) {
    return;
  }
  setInterval(function () {
    //인터벌로 실행될 코드
    fetch(`../now_reservation_for_store_jason.php?store_num=${store_num}`)
      .then((response) => {
        return response.json();
      })
      .then((nowRes) => {
        if (nowRes.length > 0) {
          whenNewReservation(nowRes);
        }
      });
  }, 5000);
}

function whenNewReservation(nowRes) {
  console.log(nowRes);
  if (confirm("예약 요청이 들어왔습니다")) {
    goPostValue(nowRes);
  }
}

function goPostValue(nowRes) {
  let f = document.createElement("form");
  let obj;
  obj = document.createElement("input");
  obj.setAttribute("type", "hidden");
  obj.setAttribute("name", "nowResJson");
  obj.setAttribute("value", JSON.stringify(nowRes));

  f.appendChild(obj);
  f.setAttribute("method", "post");
  f.setAttribute("action", "../now_reservation_for_store_proc.php");
  document.body.appendChild(f);
  f.submit();
}
