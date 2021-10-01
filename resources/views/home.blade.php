@extends('default')

@section('app')
<div id="app">
  <v-card>
    <v-toolbar
      color="cyan"
      flat
    >
      <v-toolbar-title>CT Evaluation</v-toolbar-title>

      <template v-slot:extension>
        <v-tabs
          v-model="current_tab"
          align-with-title
        >
          <v-tabs-slider color="yellow"></v-tabs-slider>

          <v-tab key="phase-1">
            Fase 1
          </v-tab>
          <v-tab key="phase-2">
            Fase 2
          </v-tab>
          <v-tab key="phase-3">
            Fase 3
          </v-tab>
        </v-tabs>
      </template>
    </v-toolbar>

    <v-tabs-items v-model="current_tab">
      <v-tab-item key="phase-1">
        <v-card>
            <v-container fluid>
                <v-row dense>
                    <v-col cols="3">
                        <v-card>
                            <v-list dense>
                                <v-list-item-group
                                    v-model="current_question"
                                    color="primary"
                                >
                                    <v-list-item 
                                        selectable
                                        v-for="(item, i) in phase_1_questions"
                                        :key="i"
                                        @click="fetchResponse(item)"                
                                    >
                                        <v-list-item-icon>
                                            <v-icon>mdi-chat-question-outline</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-content>
                                            <v-list-item-title>@{{ item.text }}</v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list-item-group>
                            </v-list>        
                        </v-card>
                    </v-col>
                    
                    <v-col cols="9">
                        <v-card height="100%" align="center">
                            @{{ content_data }}
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>

        </v-card>
      </v-tab-item>

      <v-tab-item key="phase-2">
      <v-card>
            <v-container fluid>
                <v-row dense>
                    <v-col cols="3">
                        <v-card>
                            <v-list dense>
                                <v-list-item-group
                                    v-model="current_question"
                                    color="primary"
                                >
                                    <v-list-item 
                                        selectable
                                        v-for="(item, i) in phase_2_questions"
                                        :key="i"
                                        @click="fetchResponse(item)"                
                                    >
                                        <v-list-item-icon>
                                            <v-icon>mdi-chat-question-outline</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-content>
                                            <v-list-item-title>@{{ item.text }}</v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list-item-group>
                            </v-list>        
                        </v-card>
                    </v-col>
                    
                    <v-col cols="9">
                        <v-card height="100%" align="center">
                            @{{ content_data }}
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>

      </v-card>
      </v-tab-item>

      <v-tab-item key="phase-3">
      <v-card>
            <v-container fluid>
                <v-row dense>
                    <v-col cols="3">
                        <v-card>
                            <v-list dense>
                                <v-list-item-group
                                    v-model="current_question"
                                    color="primary"
                                >
                                    <v-list-item 
                                        selectable
                                        v-for="(item, i) in phase_3_questions"
                                        :key="i"
                                        @click="fetchResponse(item)"                
                                    >
                                        <v-list-item-icon>
                                            <v-icon>mdi-chat-question-outline</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-content>
                                            <v-list-item-title>@{{ item.text }}</v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list-item-group>
                            </v-list>        
                        </v-card>
                    </v-col>
                    
                    <v-col cols="9">
                        <v-card height="100%" align="center">
                            @{{ content_data }}
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>

      </v-card>
      </v-tab-item>

    </v-tabs-items>
  </v-card>           
</div>
@endsection

@section('vue')
    <script>
        window.questions = @json($questions);
    </script>
    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: () => ({
                current_tab: 'phase-1',
                current_question: null,
                content_data: 'Wating a response',
                phase_1_questions: [],
                phase_2_questions: [],
                phase_3_questions: [],
            }),
            mounted() {
                this.phase_1_questions = window.questions.phase_1;
                this.phase_2_questions = window.questions.phase_2;
                this.phase_3_questions = window.questions.phase_3;
            },
            methods: {
                fetchResponse(item) {
                    axios.get(item.route)
                        .then(response => this.content_data = response.data);
                },
            }
        });

        var example1 = new Vue({
          el: '#example-1',
          data: {
            items: [content_data]
          }
        })

        /*new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: () => ({
                current_tab: 'phase-2',
                current_question: null,
                content_data: 'Wating a response',
                phase_2_questions: [],
            }),
            mounted() {
                this.phase_2_questions = window.questions.phase_2;
            },
            methods: {
                fetchResponse(item) {
                    axios.get(item.route)
                        .then(response => this.content_data = response.data);
                },
            }
        });

        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: () => ({
                current_tab: 'phase-3',
                current_question: null,
                content_data: 'Wating a response',
                phase_3_questions: [],
            }),
            mounted() {
                this.phase_3_questions = window.questions.phase_3;
            },
            methods: {
                fetchResponse(item) {
                    axios.get(item.route)
                        .then(response => this.content_data = response.data);
                },
            }
        });*/
    </script>
@show
