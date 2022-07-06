<template>
     <div class="d-flex justify-content-center">
        <h2>Error 404 | Page not found</h2>
        <button class="btn btn-primary" @click="$router.back()">Indietro</button>
        
        
    </div>

</template>

<script>
export default {
    name: 'NotFoundPage'
}
</script>