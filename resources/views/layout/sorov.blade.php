<div class="info-block" id="sorovs" >
    <div class="col-xs-12 info-header">
        <h4 class="text-center">@lang('blog.survey')</h4>
    </div>
    <div class="col-xs-12 force-margin" style="background-color:  white; color: black">
        <br>


        <div class="text-center">


                    <div class="col-xs-12" v-if="table.type=='stat'">
                        <div class="col-md-12">@{{ table.savol }}</div>

                        <div class="progress" v-for="index in table.javob">
                            <div class="progress-bar" role="progressbar" :aria-valuenow="index.count" aria-valuemin="0" aria-valuemax="100" :style="'width:'+index.count+'%'">
                               @{{ index.text }} @{{ index.count_round }} %
                            </div>
                        </div>
                    </div>

            <div v-if="table.type=='check'">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <table class="table table-condensed" >
                <thead>
                <tr>
                    <th>

                    @{{ table.savol }}</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>




                <tr v-for="index in table.javob">
                    <td><input type="radio" class="radio" name="chk" v-model="radios" :value=" index.group"></td>
                    <td>@{{ index.javob }}</td>

                </tr>



                </tbody>

            </table>

            <button class="btn btn-success" @click="send()" type="button">@lang('blog.vote')</button>

            </div>
        </div>
    </div>
</div>



