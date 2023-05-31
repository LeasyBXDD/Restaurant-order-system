<template>
    <van-notice-bar left-icon="volume-o" color="#1989fa" background="#ecf9ff" style="margin-bottom: 12px;"
        :scrollable="false">
        <van-swipe vertical class="notice-swipe" :autoplay="3000" :touchable="false" :show-indicators="false">
            <van-swipe-item>膳食宝塔牛逼</van-swipe-item>
            <van-swipe-item>膳食宝塔真牛逼</van-swipe-item>
            <van-swipe-item>膳食宝塔真真牛逼</van-swipe-item>
            <van-swipe-item>膳食宝塔真真真牛逼</van-swipe-item>
        </van-swipe>
    </van-notice-bar>

    <van-space :size="18" direction="vertical" style="padding: 5px;">
        <!-- 左边是名字，右边是头像 -->
        <div class="my-info">
            <div class="my-info-left">
                <div class="my-info-name">user001</div>
                <div class="my-info-id">13958958107</div>
            </div>
            <div class="my-info-right">
                <img src="https://img.yzcdn.cn/vant/cat.jpeg" alt="" />
            </div>
        </div>

        <!-- 卡片 -->


        <div class="infocard">
            <!-- 时间和标题 -->
            <p style="color: #999; font-size: 14px; padding: 10px; margin: 10px; margin-bottom: -10px;">今日饮食分析</p>
            <div style="margin-left: 20px; padding-top: 10px;">
                <p>{{ time }}</p>
                <h1>{{ good }}</h1>
            </div>
            <!-- 图表 -->
            <div style="max-height: 400px;">
                <EchartsOne></EchartsOne>
            </div>
        </div>

        <!-- 日期选择按钮 -->
        <van-button type="primary" @click="show = true" style="width: 100%;">选择日期</van-button>
        <!-- <van-cell title="选择单个日期" :value="date" @click="show = true" /> -->
        <van-calendar v-model:show="show" ref="calendar" @confirm="onConfirm" />

        <!-- 明日饮食建议和描述信息 -->
        <div class="infocard">
            <van-cell-group title="明日饮食建议">
                <van-card v-for="(item, index) in adviceList" :key="index" style="margin-left: 10px; margin-right: 10px;">
                    <template #title>
                        <div style="font-size: 16px; font-weight: bold;">{{ item.title }}</div>
                    </template>
                    <template #desc>
                        <div style="font-size: 14px; color: #999;">{{ item.desc }}</div>
                    </template>
                </van-card>
                <span
                    style="font-size: 14px; color: #999; margin-left: 10px; margin-right: 10px; padding: 10px;">*以上建议根据《中国居民膳食指南》得出，</span>
                <span
                    style="font-size: 14px; color: #999; margin-left: 15px; margin-right: 10px; padding: 10px;">结论仅供参考</span>
            </van-cell-group>
        </div>

        <Nav></Nav>
    </van-space>
</template>
    
<script>
import axios from 'axios';
import { ref } from 'vue';
import { timePickerProps } from 'vant';
import EchartsOne from '../components/EchartsOne.vue';
import Nav from '../components/Nav.vue';
import 'vant/es/card/style';
import 'vant/es/calendar/style';
import 'vant/es/button/style';


export default {
    components: {
        Nav,
        EchartsOne,
    },
    data() {
        return {
            time: null,
            good: '',
            adviceList: [],
        };
    },
    mounted() {
        // 发送请求获取时间信息
        this.getTime();
        // 发送请求获取餐品信息
        this.getGood();
        // 发送请求获取饮食建议
        this.generateAdviceList();
    },
    methods: {
        getTime() {
            // this.time = '2021-01-01'
            const now = new Date();
            const year = now.getFullYear();
            const month = now.getMonth() + 1;
            const day = now.getDate();
            this.time = `${year}-${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}`;
        },
        getGood() {
            this.good = '营养均衡';
        },
        generateAdviceList() {
            // 生成饮食建议列表
            const breakfast = ['牛奶', '鸡蛋', '面包', '水果'];
            const lunch = ['米饭', '鸡蛋', '鱼', '蔬菜'];
            const dinner = ['米饭', '鸡蛋', '鱼', '蔬菜'];
            this.adviceList.push({ title: '早餐', desc: breakfast.join('、') });
            this.adviceList.push({ title: '午餐', desc: lunch.join('、') });
            this.adviceList.push({ title: '晚餐', desc: dinner.join('、') });
        },

    },
    setup() {
        const date = ref('');
        const show = ref(false);

        const formatDate = (date) => `${date.getMonth() + 1}/${date.getDate()}`;
        const onConfirm = (value) => {

            show.value = false;
            date.value = formatDate(value);

            // 输出选择的日期
            console.log(date.value);

            // 发送选择的日期到后端
            axios.get('http://localhost/resphp/getNtt.php', {
                params: {
                    user_id: 1,
                    year: value.getFullYear().toString(),
                    month: (value.getMonth() + 1).toString(),
                    day: value.getDate().toString(),
                },
            }).then((res) => {
                console.log(res);
                // 将返回的数据传给EchartsOne组件
                EchartsOne.props.data = res.data;

            }).catch((err) => {
                console.log(err);
            });
        };

        return {
            date,
            show,
            onConfirm,
        };
    },

};

</script>
    
<style scoped>
.infocard {
    margin-top: 10px;
    background-color: #fff;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 2px 2px 6px #d9d9d9,
        -2px -2px 6px #ffffff;
}

.my-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    padding-left: 20px;

    background-color: #fff;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 2px 2px 6px #d9d9d9,
        -2px -2px 6px #ffffff;
}

.my-info-left {
    display: flex;
    flex-direction: column;
}

.my-info-name {
    font-size: 18px;
    font-weight: bold;
}

.my-info-id {
    font-size: 14px;
    color: #999;
}

.my-info-right img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

.notice-swipe {
    height: 40px;
    line-height: 40px;
}
</style>