import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import { NoticeBar } from 'vant';
import { ConfigProvider } from 'vant';
import { Col, Row } from 'vant';
import { Button } from 'vant';
import { Field, CellGroup } from 'vant';
import { Form } from 'vant';
import { Image as VanImage } from 'vant';
import { Space } from 'vant';
import { Toast } from 'vant';
import { PullRefresh } from 'vant';
import { Tabbar, TabbarItem } from 'vant';
import { Search } from 'vant';
import { Sidebar, SidebarItem } from 'vant';
import { SwipeCell } from 'vant';
import { ActionBar, ActionBarIcon, ActionBarButton } from 'vant';
import { SubmitBar } from 'vant';
import { RadioGroup, Radio } from 'vant';
import { Checkbox, CheckboxGroup } from 'vant';
import { Card } from 'vant';
import { List } from 'vant';
import { Popup } from 'vant';
import { Dialog } from 'vant';
import { Swipe, SwipeItem } from 'vant';
import { Grid, GridItem } from 'vant';
import { Divider } from 'vant';
import { Tag } from 'vant';
import { Empty } from 'vant';
import { ImagePreview } from 'vant';
import { Tab, Tabs } from 'vant';
import { Sticky } from 'vant';
import { CountDown } from 'vant';
import { TreeSelect } from 'vant';
import { Picker } from 'vant';
import { Uploader } from 'vant';
import { Overlay } from 'vant';
import { Loading } from 'vant';
import { BackTop } from 'vant';
import { Cell } from 'vant';
import { Step, Steps } from 'vant';

import '@vant/touch-emulator';

const app = createApp(App)

app.use(NoticeBar);
app.use(ConfigProvider);
app.use(Col);
app.use(Row);
app.use(Button);
app.use(Field);
app.use(CellGroup);
app.use(Form);
app.use(VanImage);
app.use(Space);
app.use(Toast);
app.use(PullRefresh);
app.use(Tabbar);
app.use(TabbarItem);
app.use(Search);
app.use(Sidebar);
app.use(SidebarItem);
app.use(SwipeCell);
app.use(ActionBar);
app.use(ActionBarIcon);
app.use(ActionBarButton);
app.use(SubmitBar);
app.use(RadioGroup);
app.use(Radio);
app.use(Checkbox);
app.use(CheckboxGroup);
app.use(Card);
app.use(List);
app.use(Popup);
app.use(Dialog);
app.use(Swipe);
app.use(SwipeItem);
app.use(Grid);
app.use(GridItem);
app.use(Divider);
app.use(Tag);
app.use(Empty);
app.use(ImagePreview);
app.use(Tab);
app.use(Tabs);
app.use(Sticky);
app.use(CountDown);
app.use(TreeSelect);
app.use(Picker);
app.use(Uploader);
app.use(Overlay);
app.use(Loading);
app.use(PullRefresh);
app.use(BackTop);
app.use(Cell);
app.use(Step);
app.use(Steps);


app.use(router)

app.mount('#app')


