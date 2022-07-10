<template>

    <div :class="`alert alert-${type}`" rol="alert">
        {{message}}
    </div>

</template>

<script>

    export default{
        name: 'Alert',
        props: ['message', 'type']
    }

</script>
