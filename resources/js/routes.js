import Home     from './components/Home'
import Member   from './components/Member'
import Clients  from './components/Clients'
import TimeLogs from './components/TimeLog'
import Events   from './components/Events'

export default {
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Home
    },
    {
      path: '/member',
      component: Member
    },
    {
      path: '/clients',
      component: Clients
    },
    {
      path: '/timelogs',
      component: TimeLogs
    },
    {
      path: '/events',
      component: Events
    }
  ]
}
