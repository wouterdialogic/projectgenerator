import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import questionsModule from './questions.js'
import Modals from './Modals.js'

// import cart from './modules/cart'
// import products from './modules/products'
// import createLogger from '../../../src/plugins/logger'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        Modals,
    },

    state: {
        count: 1,
        questions: [],
        current_question: {},
        tags: [],
        modal_level: 1,
        open_model: [],
    },

  // actions
    actions: {
        getQuestionsWith ({ commit }) {
            fetch('/api/questions').then(res => res.json()).then((questions) => {
                commit('setQuestions', questions)
            })
        },

        getAllTags ({ commit }) {
            fetch('/api/tags').then(res => res.json()).then((tags) => {
                commit('setTags', tags)
            })
        },

        getAllQuestions ({ commit }) {
            fetch('api/questions').then(res => res.json()).then((questions) => {
                commit('setQuestions', questions)
                //this.models = models;
                //this.original_models = JSON.parse(JSON.stringify(models)); 
                //this.fields = fields;
            })
           
           
            // fetch('/api/projects').then(res => res.json()).then(({ models, fields }) => {
            //     commit('setQuestions', models)
            //     //this.models = models;
            //     //this.original_models = JSON.parse(JSON.stringify(models)); 
            //     //this.fields = fields;
            // })


            // shop.getProducts(questions => {
            //     commit('setQuestions', questions)
        },
        toggle_question_tag ( commit, load ) {
            console.log(load.question_id);
            console.log(load.tag_id);
            var question_id = load.question_id;
            var tag_id = load.tag_id;
            // axios({
            //     method: 'post',
            //     url: '/user/12345',
            //     data: {
            //         firstName: 'Fred',
            //         lastName: 'Flintstone'
            //     }
            // });
            
            fetch('/api/questions/'+question_id+'/toggle_tag/'+tag_id).then(res => res.json()).then(() => { 
                //commit('setQuestions', questions)
            })
        },
        
    },

    mutations: {
        increment (state) {
            state.count++
        },

        set_current_question (state, question_id) {
            for (var question of state.questions) {
                if (question.id == question_id) {
                    state.current_question = question;
                    return;
                }
            }
        },

        open_modal (state) {
            state.modal_level ++;
        },

        close_modal (state) {
            state.modal_level --;
        },

        setQuestions (state, questions) {
            state.questions = questions
        },
        
        setTags (state, tags) {
            state.tags = tags
        },

        setAllTags (state) {
            console.log("setting");
            if (state.current_question) {
                var question_tag_ids = [];
                console.log(state.current_question)
                
                for (var question_tag of state.current_question.tags) {
                    question_tag_ids.push(question_tag.id);
                }


                for ( var tag in state.tags) {
                    console.log(tag)
                    if (question_tag_ids.includes(state.tags[tag].id)) {
                        state.tags[tag].enabled = true;
                    } else {
                        state.tags[tag].enabled = false;
                        // tag.enabled = false;
                    }
                }
            }
        }
    },

    strict: debug,
  //plugins: debug ? [createLogger()] : []
})