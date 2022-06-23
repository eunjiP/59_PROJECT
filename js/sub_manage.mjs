let moveCount = 0;
let nowSubCheck = 0;
//총할인금액 월 변경을 체크 위한 변수

let divContainer1 = document.querySelector(".total-save-price");
let divContainer2 = document.querySelector(".total-save-price__month");
let subListContainer = document.querySelector(".sub-list");
let monthSave = getSaveData();
console.log(monthSave);

console.log("list::::");
console.log(list);
printSubList();
printTotalSave();
//첫화면 총할인금액,총할인금액(display:none) 출력

//총할인금액 출력 함수
function printTotalSave(m = 0, moved = 0) {
  if (!moved) {
    divContainer1.style.display = "none";
  }
  divContainer2.textContent = "";
  if (list.length == 0) {
    anySubNone();
    return;
  }

  let key = monthSave.keys.length - 1 + m;
  console.log("key:" + key);

  divContainer2.innerHTML = `
      <div class='total-save-price__left' onclick="moveMonth(0,${monthSave.keys.length})"><</div>
      <div class='total-save-price__this-month' >${monthSave.keys[key]}</div>
      <div class='total-save-price__right' onclick="moveMonth(1,${monthSave.keys.length})">></div>
    <div class='total-save-price__month-save'>월 할인금액  ${monthSave[monthSave.keys[key]]}원</div>
 
  `;
}

//구독리스트출력함수
function printSubList() {
  for (let i = 0; i < list.length; i++) {
    let ValidityCheck = new Date(list[i].end_date + " 23:59:59") - new Date();
    console.log(ValidityCheck);
    if (ValidityCheck < 0) {
      continue;
    }
    nowSubCheck += 1;
    let imgsrc = `img/store/${list[i].store_nm}/Menu_img/${list[i].menu_num}/${list[i].menu_photo}`;

    let validity = getValidity(list[i].pay_date, list[i].end_date);

    let divEachSub = document.createElement("div");
    divEachSub.classList.add("sub-list__each");
    let subHTML = `
<div class='sub-list__img'><img src='${imgsrc}'></div>
<div class='sub-list__menu-nm'>${list[i].menu_nm}</div>
<div class='sub-list__remaining-count'>사용가능 회수 ${list[i].remaining_count}회</div>
<div class='sub-list__validity'>${validity}</div>
<div class='sub-list__price'>${list[i].subed_price}원</div>
<div class='sub-list__save-price'>총 할인금액 ${list[i].save_price}원</div>
<div class='sub-list__button'>
<div class='sub-list__detail' onclick="moveToStoreDetail(${list[i].store_num})">상세페이지</div>
<div class='sub-list__reservation' onclick="moveToReservation(${i})">예약하기</div>
</div>
`;
    divEachSub.innerHTML = subHTML;
    subListContainer.append(divEachSub);
  }
  if (nowSubCheck == 0) {
    nowSubNone();
  }
}

function moveToStoreDetail(store_num) {
  location.href = `store-detail.php?store_num=${store_num}`;
}

function getValidity(payDateTime, endDateTime) {
  let payDate = payDateTime.substr(0, 10).split("-");
  let endDate = endDateTime.split("-");
  let validity = `${payDate[0]}.${payDate[1]}.${payDate[2]} ~ ${endDate[0]}.${endDate[1]}.${endDate[2]}`;
  return validity;
}

//총할인금액-월 변경
function moveMonth(n, l) {
  if (n) {
    moveCount += 1;
  } else {
    moveCount -= 1;
  }
  if (moveCount > 0) {
    moveCount -= 1;
    return;
  } else if (moveCount <= -l) {
    moveCount += 1;
    return;
  }
  printTotalSave(moveCount, 1);
}

//구독리스트 display 스위치
function getSubList() {
  console.log("getSubList");
  divContainer1.style.display = "none";
  subListContainer.style.display = "block";
}

//총할인금액 displaay스위치
function getTotalSave() {
  subListContainer.style.display = "none";
  // printTotalSave();
  divContainer1.style.display = "block";
  printChart();
}

//예약페이지이동
function moveToReservation(i) {
  // console.log(list[i].store_num, list[i].sub_num, list[i].menu_num);
  if (list[i].remaining_count <= 0) {
    return alert("남은 횟수가 없습니다");
  }
  document.getElementById("store_num").value = list[i].store_num;
  document.getElementById("sub_num").value = list[i].sub_num;
  document.getElementById("menu_num").value = list[i].menu_num;
  document.getElementById("remaining_count").value = list[i].remaining_count;

  document.getElementById("info_form").submit();

  // location.href = "reservation.php";
}

//월별 할인금액 데이터산출
function getSaveData() {
  let savePriceMonth = {};
  savePriceMonth["keys"] = [];
  for (let i = 0; i < list.length; i++) {
    let endAt = list[i].end_date;
    let payAt = list[i].pay_date.substr(0, 10);
    let endDate = new Date(endAt);
    let payDate = new Date(payAt);

    let eachSubStartMonth = payDate.getMonth();
    let eachSubStartYear = payDate.getFullYear();
    let nextMonthFirst = new Date(eachSubStartYear, eachSubStartMonth + 1, 1, 09);

    let thisMonthDays = (nextMonthFirst - payDate) / (24 * 60 * 60 * 1000);
    let eachSubDays = (endDate - payDate) / (24 * 60 * 60 * 1000);
    let nextMonthDays = eachSubDays - thisMonthDays;
    let daySavePrice = list[i].save_price / eachSubDays;

    let textThisMonth = eachSubStartMonth + 1 < 10 ? "0" + (eachSubStartMonth + 1) : eachSubStartMonth + 1;

    let textNextMonth = nextMonthFirst.getMonth() + 1 < 10 ? "0" + (nextMonthFirst.getMonth() + 1) : nextMonthFirst.getMonth() + 1;

    if (typeof savePriceMonth[`${eachSubStartYear}.${textThisMonth}`] === "undefined") {
      savePriceMonth[`${eachSubStartYear}.${textThisMonth}`] = 0;
      savePriceMonth["keys"].push(`${eachSubStartYear}.${textThisMonth}`);
    }
    savePriceMonth[`${eachSubStartYear}.${textThisMonth}`] += daySavePrice * thisMonthDays;

    if (typeof savePriceMonth[`${eachSubStartYear}.${textNextMonth}`] === "undefined") {
      savePriceMonth[`${eachSubStartYear}.${textNextMonth}`] = 0;
      savePriceMonth["keys"].push(`${eachSubStartYear}.${textNextMonth}`);
    }
    savePriceMonth[`${eachSubStartYear}.${textNextMonth}`] += daySavePrice * nextMonthDays;
  }

  let savePriceMonthCeil = {};
  savePriceMonthCeil["keys"] = savePriceMonth["keys"];

  for (let j = 0; j < savePriceMonth["keys"].length; j++) {
    savePriceMonthCeil[`${savePriceMonth["keys"][j]}`] = Math.ceil(savePriceMonth[`${savePriceMonth["keys"][j]}`]);
  }

  return savePriceMonthCeil;
}

console.log(monthSave.keys);

let monthSaveVals = [];
monthSave.keys.forEach((val) => {
  monthSaveVals.push(monthSave[`${val}`]);
});
console.log(monthSaveVals);

function printChart() {
  new Chart(document.getElementById("bar-chart"), {
    type: "bar",
    data: {
      labels: monthSave.keys,
      datasets: [
        {
          // label: "Population (millions)",
          backgroundColor: "#10B981",
          data: monthSaveVals,
        },
      ],
    },
    options: {
      legend: { display: false },
      title: {
        // display: true,
        // text: "Predicted world population (millions) in 2050",
      },
    },
  });
}

function nowSubNone() {
  let noList = document.createElement("div");
  noList.className += "nowSubNone";
  noList.innerHTML = "<div>현재 구독중인 상품이 없습니다</div>";
  document.querySelector(".sub-list").append(noList);
}

function anySubNone() {
  document.querySelector(".total-save-price__month").style.display = "none";
  document.querySelector(".total-save-price__graph").style.display = "none";

  let noList = document.createElement("div");
  noList.className += "anySubNone";
  noList.innerHTML = "<div>구독 내역이 없습니다<br>합리적인 구독 서비스를 이용해보세요</div>";
  document.querySelector(".total-save-price").append(noList);
}
