<template>
    <van-space :size="20" direction="vertical">
        <!-- 通知栏 -->
        <van-notice-bar left-icon="volume-o" text="后厨全程监控，扫描桌上二维码即可观看后厨详细情况，20+“4K超高清摄像头”24小时直播！" />
        <!-- 订单信息 -->
        <h3 style="font-weight:bolder">感谢您的耐心等待！
            <span style="font-size: small; font-weight: bold;">
                <br>后厨正在拼命备餐 o(≧口≦)o
            </span>
        </h3>
        <van-card :num="123456789" :price="1234.56" desc="每天都要好好吃饭哦" :title="`${orderDay} ${orderTime} 的订单`"
            thumb="https://www.logo9.net/userfiles/images/288z4.jpg" />
        <h4 style="text-align: center;">预计还要：{{ remainingTime }} 分钟</h4>
        <!-- 进度条 -->
        <van-steps :active="active" click-step>
            <van-step>买家下单</van-step>
            <van-step>商家接单</van-step>
            <van-step>正在出餐</van-step>
            <van-step>出餐完成</van-step>
        </van-steps>
        <!-- 显示订购餐品的内容并显示是否出餐 -->
        <van-list>
            <h4 style="margin: 10px; font-weight: bolder;">出餐情况</h4>
            <van-cell v-for="(dish, index) in dishes" :key="index" :title="dish.name" :value="dish.status" />
        </van-list>


    </van-space>

    <Nav></Nav>
</template>

<script>
import { ref } from 'vue';
import Nav from '../components/Nav.vue';
import 'vant/es/steps/style'
import 'vant/es/step/style'
import 'vant/es/notice-bar/style'
import 'vant/es/card/style'



export default {
    components: {
        Nav,
    },
    setup() {
        const active = ref(1);
        return { active };
    },
    data() {
        return {
            orderDay: '',
            orderTime: '',
            remainingTime: '',
            dishes: [],
        };
    },
    mounted() {
        // 发送请求获取订单时间信息
        this.getOrderDay();
        this.getOrderTime();
        // 发送请求获取预计还要的时间信息
        this.getRemainingTime();
        // 发送请求获取餐品信息
        this.getDishes();
    },
    methods: {
        getOrderDay() {
            // 发送请求获取订单日期信息的逻辑
            // 在请求成功后将订单日期信息赋值给 orderDay 属性
            this.orderDay = '2023年1月1日';
        },
        getOrderTime() {
            // 发送请求获取订单时间信息的逻辑
            // 在请求成功后将订单时间信息赋值给 orderTime 属性
            this.orderTime = '中午';
        },
        getRemainingTime() {
            // 发送请求获取预计还要的时间信息的逻辑
            // 在请求成功后将预计还要的时间信息赋值给 remainingTime 属性
            this.remainingTime = '15';
        },
        getDishes() {
            // 发送请求获取餐品信息的逻辑
            // 在请求成功后将餐品信息赋值给 dishes 数组
            this.dishes = [
                { name: '鱼香茄子', status: '未出餐' },
                { name: '番茄炒蛋', status: '未出餐' },
                { name: '爆炒黄牛肉', status: '未出餐' },
                { name: '新疆大盘鸡', status: '未出餐' },
                { name: '清炒时蔬', status: '未出餐' },
            ];
        },
    },

};

</script>

<style scoped></style>