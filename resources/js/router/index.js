import {createWebHistory, createRouter} from "vue-router";

import Navbars from '../App.vue';
import Services from '../components/Services/Index.vue';
import Titles from '../components/Services/Titles.vue';
import Users from '../components/Users/Index.vue';
import AddUser from '../components/Users/Add.vue';
import EditUser from '../components/Users/Edit.vue';
import Login from '../pages/Login.vue';
import Locations from '../components/Locations/Index.vue';
import AddLocation from '../components/Locations/Add.vue';
import EditLocation from '../components/Locations/Edit.vue';
import Equips from '../components/Equips/Index.vue';
import AddEquip from '../components/Equips/Add.vue';
import EditEquip from '../components/Equips/Edit.vue';
import Kids from '../components/Kids/Index.vue';
import AddKid from '../components/Kids/Add.vue';
import EditKid from '../components/Kids/Edit.vue';
import KidServices from '../components/KidServices/Index.vue';
import AddKidService from '../components/KidServices/Add.vue';
import EditKidService from '../components/KidServices/Edit.vue';
import Reports from '../components/Reports/Index.vue';
import Cards from '../components/Cards/Index.vue';
import AddCard from '../components/Cards/Add.vue';
import EditCard from '../components/Cards/Edit.vue';
import Adds from '../components/Adds/Index.vue';
import AddAdd from '../components/Adds/Add.vue';
import EditAdd from '../components/Adds/Edit.vue';
import Data from '../components/Data/Index.vue';
import AddData from '../components/Data/Add.vue';
import EditData from '../components/Data/Edit.vue';

export const routes = [
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'navbars',
        path: '/navbars',
        component: Navbars
    },
    {
        name: 'users',
        path: '/users',
        component: Users
    },
    {
        name: 'adduser',
        path: '/users/add',
        component: AddUser
    },
    {
        name: 'edituser',
        path: '/users/edit/:id',
        component: EditUser
    },
    {
        name: 'locations',
        path: '/locations',
        component: Locations
    },
    {
        name: 'addlocation',
        path: '/locations/add',
        component: AddLocation
    },
    {
        name: 'editlocation',
        path: '/locations/edit/:id',
        component: EditLocation
    },
    {
        name: 'equips',
        path: '/equips',
        component: Equips
    },
    {
        name: 'addequip',
        path: '/equips/add',
        component: AddEquip
    },
    {
        name: 'editequip',
        path: '/equips/edit/:id',
        component: EditEquip
    },
    {
        name: 'kids',
        path: '/kids',
        component: Kids
    },
    {
        name: 'addekid',
        path: '/kids/add',
        component: AddKid
    },
    {
        name: 'editkid',
        path: '/kids/edit/:id',
        component: EditKid
    },
    {
        name: 'kidservices',
        path: '/kids_services',
        component: KidServices
    },
    {
        name: 'addekidservices',
        path: '/kid_services/add',
        component: AddKidService
    },
    {
        name: 'editkidservices',
        path: '/kid_services/edit/:id',
        component: EditKidService
    },
    {
        name: 'services',
        path: '/services',
        component: Services
    },
    {
        name: 'titles',
        path: '/services/titles',
        component: Titles
    },
    {
        name: 'reports',
        path: '/reports',
        component: Reports
    },
    {
        name: 'cards',
        path: '/cards',
        component: Cards
    },
    {
        name: 'addecard',
        path: '/cards/add',
        component: AddCard
    },
    {
        name: 'editcard',
        path: '/cards/edit/:id',
        component: EditCard
    },
    {
        name: 'adds',
        path: '/additional_service',
        component: Adds
    },
    {
        name: 'addadd',
        path: '/additional_service/add',
        component: AddAdd
    },
    {
        name: 'editadd',
        path: '/additional_service/edit/:id',
        component: EditAdd
    },
    {
        name: 'data',
        path: '/data/:id',
        component: Data
    },
    {
        name: 'adddata',
        path: '/data/add',
        component: AddData
    },
    {
        name: 'editdata',
        path: '/data/edit/:id',
        component: EditData
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
