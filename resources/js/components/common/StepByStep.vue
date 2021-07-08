<template>
    <div class="box-step">
<!--  <ul id="progressbar" class="text-center">
            <li class="active" id="step1"><div class="d-none d-md-block">STEP 1</div></li>
            <li class="active" id="step2"><div class="d-none d-md-block">STEP 2</div></li>
            <li class="active" id="step3"><div class="d-none d-md-block">STEP 3</div></li>
            <li class="" id="step4"><div class="d-none d-md-block">STEP 4</div></li>
            <li class="" id="step5"><div class="d-none d-md-block">STEP 5</div></li>
            <li class="" id="step6"><div class="d-none d-md-block">STEP 5</div></li>
        </ul>-->

        <ul id="progressbar" class="text-center">
            <li   v-for="step in dsSteps" :key="dsSteps.id" :id="'step'+step.id" :class="step.state" ><div class="d-none d-md-block">{{step.name}}</div></li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            props: ["dsSteps"],
        };
    },
    created: function () {
        this.dsSteps = this.$attrs.dsSteps
    },

}
</script>

<style lang="scss">
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    width: 16.66%;
    float: left;
    position: relative;
    font-weight: 400;
    z-index: 2 !important;
}



#progressbar #step1:before {
    content: "1";
}

#progressbar #step2:before {
    content: "2";
}

#progressbar #step3:before {
    content: "3";
}
#progressbar #step4:before {
    content: "4";
}
#progressbar #step5:before {
    content: "5";
}
#progressbar #step6:before {
    content: "6";
}
#progressbar #step7:before {
    content: "7";
}

#progressbar #step8:before {
    content: "8";
}

#progressbar #step9:before {
    content: "9";
}

#progressbar #step10:before {
    content: "10";
}



#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    background: #455A64;
    border-radius: 50%;
    margin: auto;
    color: #fff;
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: #455A64;
    position: absolute;
    left: 0;
    top: 21px;
    z-index: -1!important;
}


#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px
}

#progressbar  li.active:before,
#progressbar  li.active:after {
    background: red!important;
}
.box-step{

    z-index: 1000;
}

</style>
