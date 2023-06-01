<template>
    <van-notice-bar left-icon="volume-o" color="#1989fa" background="#ecf9ff" style="margin-bottom: 12px;"
        :scrollable="false">
        <van-swipe vertical class="notice-swipe" :autoplay="3000" :touchable="false" :show-indicators="false">
            <van-swipe-item v-for="(item, index) in noticeList" :key="index">{{ item }}</van-swipe-item>
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
        <!-- 日期选择按钮 -->
        <!-- <van-button type="primary" @click="show = true" style="width: 100%; border-radius: 12px; box-shadow: 2px 2px 6px #d9d9d9,
        -2px -2px 6px #ffffff;">选择日期</van-button> -->
        <!-- <van-cell title="选择单个日期" :value="date" @click="show = true" /> -->
        <!-- <van-calendar v-model:show="show" ref="calendar" @confirm="onConfirm" :min-date="minDate" :max-date="maxDate" /> -->
        <!-- <van-cell title="选择日期" :value="time" is-link @click="show = true" />
        <van-popup v-if="show" position="bottom">
            <van-calendar v-model="date" :min-date="minDate" :max-date="maxDate" @confirm="getTime" />
        </van-popup> -->
        <div>
            <van-cell title="选择日期" :value="time" is-link @click="showCalendar = true" />
            <van-calendar v-model="date" :min-date="minDate" :max-date="maxDate" :show="showCalendar"
                @confirm="onConfirm" />
        </div>

        <div class="infocard">
            <!-- 时间和标题 -->
            <p style="color: #999; font-size: 14px; padding: 10px; margin: 10px; margin-bottom: -10px;">今日饮食分析</p>
            <div style="margin-left: 20px; padding-top: 10px;">
                <p>{{ time }}</p>
                <h1>{{ good }}</h1>
            </div>
            <!-- 图表 -->
            <div style="max-height: 400px; padding-bottom: 18px;">
                <EchartsOne></EchartsOne>
            </div>
        </div>


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
import 'vant/es/notice-bar/style';
import 'vant/es/popup/style';


export default {
    components: {
        Nav,
        EchartsOne,
    },
    data() {
        return {
            noticeList: [], // 轮播图的内容数组
            time: null,
            good: '',
            adviceList: [],
            date: new Date(),
            // show: false,
            showCalendar: false, // 将 showCalendar 变量初始化为 false
            minDate: new Date(2000, 0, 1),
            maxDate: new Date(),
        };
    },
    mounted() {
        // 发送请求获取时间信息
        this.getTime();
        // 发送请求获取餐品信息
        this.getGood();
        // 发送请求获取饮食建议
        this.generateAdviceList();
        // 在组件挂载后，动态获取轮播图的内容
        this.getNoticeList();
    },
    methods: {
        getNoticeList() {
            // 发送 HTTP 请求，获取轮播图的内容
            // ...
            // 假设请求成功后，将轮播图的内容存储在 this.noticeList 中
            this.noticeList = [
                "膳食宝塔是营养平衡指南",
                "帮助人们选择健康食谱",
                "以塔形图形象展示食物",
                "包括11个类别，提供建议摄入量",
                "倡导多样化饮食结构",
                "避免单一食物过量",
                "是中国推广营养健康的标志性项目"
            ];
        },
        getTime() {
            const date = this.date;
            console.log(date);
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const day = date.getDate();
            this.time = `${year}-${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}`;
            this.showCalendar = false; // 选择日期后关闭日历弹窗
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
        formatDate(date) {
            return `${date.getMonth() + 1}/${date.getDate()}`;
        },
        onConfirm(value) {
            const date = new Date(value);
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            const formattedDate = `${year}-${month}-${day}`;
            console.log(formattedDate);

            // 发送选择的日期到后端
            axios
                .get('http://localhost/resphp/getNtt.php', {
                    params: {
                        id: 1,
                        year: year,
                        month: month,
                        day: day,
                    },
                })
                .then((res) => {
                    console.log(res);
                    // 将返回的数据传给EchartsOne组件
                    EchartsOne.props.data = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
            this.showCalendar = false; // 选择日期后关闭日历弹窗
        },

    }

};

</script>
    
<style scoped>
@import 'vant/es/calendar/index.css';
@import 'vant/es/popup/index.css';

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