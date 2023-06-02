<template>
    <van-space :size="20" direction="vertical">
        <!-- 通知栏 -->
        <van-notice-bar left-icon="volume-o" text="后厨全程监控，扫描桌上二维码即可观看后厨详细情况，20个“陆病弱闻4K超高清摄像头”24小时直播！" />
        <!-- 订单信息 -->
        <van-row>
            <van-col span="18">
                <span style="text-align: left;">
                    <h3 style="font-weight:bolder">感谢您的耐心等待！
                        <span style="font-size: small; font-weight: bold;">
                            <br>后厨正在拼命备餐 o(≧口≦)o
                        </span>
                    </h3>
                </span>

            </van-col>
            <van-col span="6">
                <span class="testBtn">
                    <van-button size="small" type="primary" plain text="测试出餐" @click="updateActive" />
                    <!-- <van-button size="small" type="primary" plain text="测试出餐" @click="serveDish" /> -->
                </span>
            </van-col>
        </van-row>

        <van-card :price="price" desc="每天都要好好吃饭哦" :title="`${orderDay} ${orderTime} 的订单`"
            thumb="https://www.logo9.net/userfiles/images/288z4.jpg">
            <!-- 刷新状态按钮 -->
        </van-card>
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
            <van-cell v-for="(dish, index) in dishes" :key="index" :title="dish.name" :value="dish.status">
                {{ dish.status }}
            </van-cell>
            <!-- <div>active: {{ active }}</div> -->
            <!-- <van-cell v-for="(dish, index) in dishes" :key="index" :title="dish.name" :value="dish.status" /> -->
        </van-list>


    </van-space>

    <Nav></Nav>
</template>

<script>
import { ref } from 'vue';
import { showToast } from 'vant';
import axios from 'axios';
import Nav from '../components/Nav.vue';
import 'vant/es/steps/style'
import 'vant/es/step/style'
import 'vant/es/notice-bar/style'
import 'vant/es/card/style'
import 'vant/es/button/style'


export default {
    components: {
        Nav,
    },
    setup() {
        // const active = ref(1);
        // return { active };
    },
    data() {
        return {
            orderDay: '',
            orderTime: '',
            remainingTime: '',
            dishes: [],
            price: 0,
            active: 1,
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
            this.orderDay = '2023年6月5日';
        },
        getOrderTime() {
            // 发送请求获取订单时间信息的逻辑
            // 在请求成功后将订单时间信息赋值给 orderTime 属性
            this.orderTime = '下午';
        },
        getRemainingTime() {
            // 发送请求获取预计还要的时间信息的逻辑
            // 在请求成功后将预计还要的时间信息赋值给 remainingTime 属性
            this.remainingTime = '20';
        },
        getDishes() {
            axios.get('http://localhost/resphp/getOrder.php').then(response => {
                // this.dishes = response.data.dishes;
                // this.price = response.data.price;
                // 测试数据
                const dishes = [
                    { name: '米饭', status: '未出餐' },
                    { name: '酱油鸡蛋炒饭', status: '未出餐' },
                    { name: '辣子鸡', status: '未出餐' },
                    { name: '加多宝', status: '未出餐' },
                ];
                this.dishes = dishes;
                console.log(this.dishes);
            }).catch(error => {
                console.log(error);
            });
        },
        serveDish() {
            console.log('serveDish', this.dishes.length);
            const index = this.dishes.findIndex(dish => dish.status === '未出餐');
            if (index >= 0) {
                this.dishes[index].status = '已出餐';
            }
        },
        updateActive() {
            this.remainingTime -= 5;
            if (this.remainingTime <= 0) {
                showToast('订单已完成');
                this.remainingTime = 0;
                // 一秒后，跳转到myInfo页面
                setTimeout(() => {
                    this.$router.push('/myInfo');
                }, 2000);
            }
            // 发送请求获取订单状态信息的逻辑
            // 在请求成功后将订单状态信息赋值给 active 属性
            const id = 1; // replace with the correct user id
            axios.get(`http://localhost/resphp/getOrder.php?id=${id}`)
                .then(response => {
                    if (response.data[0].code === 1) {
                        const orders = response.data[0].data;
                        for (let i = 0; i < orders.length; i++) {
                            console.log(`订单号：${orders[i].order_number}，状态：${orders[i].status}`);
                        }
                    } else {
                        // console.log('获取订单状态失败');
                        // 测试用
                        console.log('serveDish', this.dishes.length);
                        const index = this.dishes.findIndex(dish => dish.status === '未出餐');
                        if (index >= 0) {
                            this.dishes[index].status = '已出餐';
                        }
                        if (this.active === 1) {
                            this.active = 2;
                        } else if (this.active === 2) {
                            const allServed = this.dishes.every(dish => dish.status === '已出餐');
                            if (allServed) {
                                this.active = 3;
                            }
                        }
                    }
                }).catch((err) => {
                    console.log('请求失败', err);
                });
        },
    },

};

</script>

<style scoped>
.testBtn {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
</style>