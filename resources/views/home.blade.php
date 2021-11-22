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
            Phase 1
          </v-tab>
          <v-tab key="phase-2">
            Phase 2
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
            <form id="createPersonForm" method="post" action="{{ route('create_person') }}" enctype="formdata">
              <v-row dense>
                <div class="col-3 d-flex flex-column">
                  <label for='name'>Name:</label>
                  <label for='last_name'>Last Name:</label>
                  <label for='birth_date'>Birth date:</label>
                  <label for='gender'>Gender:</label>
                  <label for='country'>Country:</label>
                </div>
                <div class="col-3 d-flex flex-column">
                  <input class="border" type="text" name="name" id="name"/>
                  <input class="border" type="text" name="last_name" id="last_name"/>
                  <input class="border" type="date" name="birth_date" id="birth_date"/>
                  <select class="border" name="gender" id="gender">
                    <option value="f">Femenine</option>
                    <option value="m">Masculine</option>
                  </select>
                  <input class="border" type="text" name="country" id="country"/>
                  <button type="submit" class="btn-secondary">Create</button>
                </div>
              </v-row>
            </form>
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
            }),
            mounted() {
                this.phase_1_questions = window.questions.phase_1;
            },
            methods: {
                fetchResponse(item) {
                    axios.get(item.route)
                        .then(response => this.content_data = response.data);
                },
            }                
        });
    </script>
@endsection
