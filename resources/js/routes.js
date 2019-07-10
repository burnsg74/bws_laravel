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
      path: '/portal/member',
      component: Member
    },
    {
      path: '/portal/clients',
      component: Clients
    },
    {
      path: '/portal/timelogs',
      component: TimeLogs
    },
    {
      path: '/portal/events',
      component: Events
    },
    {
      path: '/portal/calendar',
      component: Calendar
    },
    {
      path: '/portal/projects',
      component: Projects
    },
    {
      path: '/portal/tasks',
      component: Tasks
    },
    {
      path: '/portal/task/:id?',
      component: Task,
      props: true
    }
  ]
}
