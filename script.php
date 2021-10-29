<script>

const img = document.querySelector("img");
const screen = document.querySelector(".screen");
const canvas = document.querySelector("canvas");
const beer = document.querySelector(".beer");
const scoreP = document.querySelector("#scoreP");
const myRange = document.querySelector("#myRange");
let score = 0;
let circles = [];
let speed = Math.abs(myRange.value);

let x = 0;

let size = 1;
img.style.width = 100 * size + "px";
img.style.height = 75 * size + "px";

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
const context = canvas.getContext("2d");

let velocity = {X: speed, Y: speed, size: 0.03}



setInterval(() => {
  speed = Math.abs(myRange.value);
  
  if (hitRight()){
    velocity.X = -speed;
  } 

  if (hitLeft()){
    velocity.X = speed;
  }

  if (hitTop()){
    velocity.Y = speed;
  }
  
  if (hitBot()){
    velocity.Y = -speed;
  }

  /*
  if (tooBig()){
    velocity.size = -0.03;
  }

  if (tooSmall()){
    velocity.size = 0.03;
  }
  */

  drinkBeer();
  if (ImagesTouching(img.offsetLeft, img.offsetTop, img, beer.offsetLeft, beer.offsetTop, beer)){
    score++;
    scoreP.textContent = score;
    spawnBeer();
  }

  moveImg();
  drawCircles();
  sizeImg();
}, 10);

function hitRight(){
  if (parseInt(img.style.left) > window.innerWidth - 100*size){
    return true;
  } else {
    return false;
  }
}

function hitLeft(){
  if (parseInt(img.style.left) <= 0){
    return true;
  } else {
    return false;
  }
}

function hitTop(){
  if (parseInt(img.style.top) <= 0){
    return true;
  } else {
    return false;
  }
}

function hitBot(){
  if (parseInt(img.style.top) > window.innerHeight - 75*size){
    return true;
  } else {
    return false;
  }
}


function moveImg(){
  img.style.left = img.offsetLeft + velocity.X + "px";
  img.style.top = img.offsetTop + velocity.Y + "px";
}

function drawCircles(){
  const circle = {X: img.offsetLeft+(50*size), Y: img.offsetTop+(37.5*size), size: 10*size}
  
  context.beginPath();
  context.arc(circle.X, circle.Y, circle.size, 0, 2 * Math.PI);

  context.fill();
  context.strokeStyle = 'cyan';
  context.lineWidth = 1;
  context.stroke();

  context.fillStyle = "rgba(0, 0, 0, 0.04)"
  context.fillRect(0, 0, canvas.width, canvas.height);

  circles.push(circle);
  removeCircles();
}

function removeCircles(){
  if (circles.length > 100){
    const circle = circles[0];

    context.beginPath();
    context.arc(circle.X, circle.Y, circle.size, 0, 2 * Math.PI);

    context.fill();
    context.strokeStyle = 'black';
    context.lineWidth = 20;
    context.stroke();

    circles.shift();
  }
}

document.addEventListener("keydown", e=>{
  switch (e.key) {
    case "ArrowLeft":
      velocity.X = -speed;
      velocity.Y = 0;
      break;
    case "ArrowRight":
      velocity.X = speed;
      velocity.Y = 0;
    break;
    case "ArrowUp":
      velocity.Y = -speed;
      velocity.X = 0;
      break;
    case "ArrowDown":
      velocity.Y = speed;
      velocity.X = 0;
    break; 
    case "r":
      spawnBeer();
    break; 
  }
})

function sizeImg(){
  x += speed * 0.003;
  size = Math.abs(Math.sin(x))*1.5;
  img.style.width = 100 * size + "px";
  img.style.height = 75 * size + "px";
}

function tooBig(){
  if (size >= 3){
    return true;
  } else {
    return false;
  }
}

function tooSmall(){
  if (size <= 0.5){
    return true;
  } else {
    return false;
  }
}

function drinkBeer(){

}

function spawnBeer(){
  beer.style.left = Math.random() * (window.innerWidth - beer.width) + "px";
  beer.style.top = Math.random() * (window.innerHeight - beer.height) + "px";

}

function ImagesTouching(x1, y1, img1, x2, y2, img2) {
  if (x1 >= x2+img2.width || x1+img1.width <= x2) return false;   // too far to the side
  if (y1 >= y2+img2.height || y1+img1.height <= y2) return false; // too far above/below
  return true;                                                    // otherwise, overlap   
}

spawnBeer();


</script>