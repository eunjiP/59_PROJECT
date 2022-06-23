console.log(document.querySelector(".swiper-slide2"));

// <div class="day-box"></div>
// <div class="time-box"></div>
console.log(document.querySelector(".swiper-slide2"));

let howManyDays = 30;
let howManyTimes = 48;

let divDayContainer = document.querySelector(".day-box");
let divTimeContainer = document.querySelector(".time-box");

let orderStartTime = new Date();
// console.log orderStartTime);
orderStartTime.setMinutes(orderStartTime.getMinutes() + requiredTimeMin);

function makeResTimes(n = howManyTimes) {
  let year = orderStartTime.getFullYear(); // 년도
  let month = orderStartTime.getMonth(); // 월
  let date = orderStartTime.getDate(); // 날짜
  let hours = checkFirstDay ? orderStartTime.getHours() : 23; // 시
  let minutes = checkFirstDay ? orderStartTime.getMinutes() : 30; // 분

  let min30;
  let hour30;
  if (minutes < 30) {
    min30 = 30;
    hour30 = hours;
  } else if (minutes < 60) {
    min30 = 0;
    hour30 = hours + 1;
  }

  let openTimeH = openTime.split(":")[0];
  let openTimeM = openTime.split(":")[1];
  let closeTimeH = closeTime.split(":")[0];
  let closeTimeM = closeTime.split(":")[1];
  let j = 0;

  for (let i = 0; i < n; i++) {
    let resTime = new Date(year, month, date, hour30, min30 + i * 30);
    let resHour = resTime.getHours();
    let resMinutes = resTime.getMinutes();

    if (resHour < openTimeH) {
      continue;
    } else if (resHour == openTimeH && resMinutes < openTimeM) {
      continue;
    }

    if (resHour > closeTimeH) {
      break;
    } else if (resHour == closeTimeH && resMinutes > closeTimeM) {
      // console.log(resMinutes + "," + closeTimeM);
      break;
    }

    if (checkFirstDay && resHour == 0) {
      break;
    }

    resMinutes = resMinutes ? resMinutes : "00";
    if (resHour < 10) {
      resHour = "0" + resHour;
    }
    checked = j++ ? "" : "checked";

    valueTime = resHour + ":" + resMinutes;

    let divTimeBox = document.createElement("div");
    divTimeBox.className = "time_num";
    divTimeBox.innerHTML = `<input type="radio" name="time" ${checked} value=${valueTime} id=${valueTime}><label for=${valueTime}>${valueTime}</label>`;
    document.querySelector(".swiper-slide2").append(divTimeBox);
  }
}
function makeResDays(n = howManyDays) {
  let makeResStartTime = orderStartTime;
  for (let i = 0; i < n; i++) {
    makeResStartTime.setDate(makeResStartTime.getDate() + (i ? 1 : 0));
    // console.log(makeResStartTime);
    let pickupDate = makeResStartTime.getDate();
    let pickupYear = makeResStartTime.getFullYear();
    let pickupMonth = makeResStartTime.getMonth() + 1;
    fullDate = pickupYear + "-" + pickupMonth + "-" + pickupDate;

    checked = i ? "" : "checked";
    let divDayBox = document.createElement("div");
    divDayBox.className = "day_num swiper-slide";
    divDayBox.innerHTML = `<input type="radio" name="day" id="day${i}" ${checked} onclick="getTimes()" value="${fullDate}"><label for="day${i}">${pickupDate}</label>`;
    // divDayContainer.append(divDayBox);
    document.querySelector(".swiper-wrapper1").append(divDayBox);
    // console.log(pickupDate);
  }
}

makeResDays(howManyDays);
// let checkFirstDay = true;
let checkFirstDay = false;
makeResTimes(howManyTimes);

function getTimes() {
  document.querySelector(".swiper-slide2").textContent = "";
  if (event.target.id == "day0") {
    checkFirstDay = true;
  } else {
    checkFirstDay = false;
  }
  // console.log(checkFirstDay);
  makeResTimes();
}

// test11
