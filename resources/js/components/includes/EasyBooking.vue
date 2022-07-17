<template>
     <div class="d-flex flex-column align-items-center easy-booking-grad">

        <div class="p-4">
            <h4 class="text-center text-dark">
                Trovare la struttura ideale per la tua vacanza non è mai stato così semplice. <br>
                Cosa aspetti? Prova per credere! 
            </h4>
        </div>

        <div class="p-4 text-center">
            <router-link :to="{ name: 'advancedSearch'}" class="btn btn_outline_green shadow-none">
                Cerca 
            </router-link>
        </div>
        
    </div>
</template>

<script>
export default {
    name: 'EasyBooking'
}
</script>

<style lang="scss" scoped>
    
    .easy-booking-grad {
        background: rgb(47,166,143);
        background: linear-gradient(90deg, rgba(47,166,143,0.8463760504201681) 0%, rgba(34,179,151,0.6979166666666667) 30%, rgba(38,175,148,0.4990371148459384) 60%, rgba(25,188,156,0.39539565826330536) 100%);

        h4 {
            // color: #091d43;
            line-height: 1.5em;
        }
    }

    @media screen and (max-width: 525px) {
        h4 {
            font-size: 1.2em;
        }
    }

</style>