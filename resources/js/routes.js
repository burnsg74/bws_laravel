import Home     from './components/Home'
import Member   from './components/Member'
import Clients  from './components/Clients'
import TimeLogs from './components/TimeLog'
import Events   from './components/Events'
import Calendar   from './components/Calendar'
import Projects   from './components/Projects'
import Tasks   from './components/Tasks'
import Task   from './components/Task'

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
    },
    {
      path: '/calendar',
      component: Calendar
    },
    {
      path: '/projects',
      component: Projects
    },
    {
      path: '/tasks',
      component: Tasks
    },
    {
      path: '/task/:id?',
      component: Task,
      props: true
    }
  ]
}
