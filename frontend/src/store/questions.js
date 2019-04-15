/** VUEX module for todos management in todolist app **/

export default {
  namespaced: true,
  // -----------------------------------------------------------------
  state: {
    // properties to store todos data
    questions: [],
  },
  // -----------------------------------------------------------------
  getters: {
    GET_QUESTIONS ({ commit }) {
        fetch('api/questions').then(res => res.json()).then((questions) => {
            commit('SET_QUESTIONS', questions)
        })
    },
  },
  // -----------------------------------------------------------------
  mutations: {
    SET_QUESTIONS (state, questions) {
        state.questions = questions
    },
  },
  // -----------------------------------------------------------------
  actions: {
    fetch: context => {
      // stuf to retrieve all the logged in user's todos from backend
    },
    create: (context, todoData) => {
      // stuff to create a new todo on the backend : CRUD CREATE ACTION
    },
    read: (context, id) => {
      // stuff to retrieve a particular todo data from the backend : CRUD READ ACTION
    },
    update: (context, todoData) => {
      // stuff to update a particular todo data to the backend : CRUD UPDATE ACTION
    },
    delete: (context, id) => {
      // stuff to erase a particular todo on the bockend : CRUD DELETE ACTION
    }
  }
}