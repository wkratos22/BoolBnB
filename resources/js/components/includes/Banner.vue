<template>

   
        <div class="banner animated tada">
            <div class=" big-text animated tada">95% OFF</div>
            <div>the entire store</div>
            <a href="#">Go to store</a>
        </div>
    
</template>

<script>
export default {
   name: "Banner"
}
</script>

<style>

.banner {
    width: 100%;
    background: url(https://i0.wp.com/media.giphy.com/media/5ERaOy5fQEIAU/giphy.gif);
    /*https://i0.wp.com/media.giphy.com/media/5ERaOy5fQEIAU/giphy.gif*/
    background-size: cover;
    font-size: 50px;
    color: #fff;
    text-align: center;
    padding: 20px 5px;
}

.big-text {
    font-size: 50px;
    font-weight: 800;
    animation-delay: 1s;
}

.banner a {
    display: inline-block;
    background: #fff;
    color: #36465d;
    text-transform: uppercase;
    padding: 5px;
    text-decoration: none;
    font-size: 20px;
    transition: .3s;
}

.banner a:hover {
    background: #333;
    color: #fff;
    padding: 15px 20px;
}


</style>