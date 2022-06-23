const storeRating = document.querySelector('.store--rating');
const ratingPoint = storeRating.querySelector('.ratingPoint').innerHTML;
const starsInner = storeRating.querySelector('.stars-inner');
if (ratingPoint !== null) {
  const starPercentage = (parseFloat(ratingPoint) / 5) * 100;
  starsInner.style.width = `${starPercentage}%`;
}
