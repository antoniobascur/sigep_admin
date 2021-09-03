<template>
    <div>
        <form ID="form" class="modal-form" @submit.prevent="validate">
            <H5><i class="fa fa-chevron-right" aria-hidden="true"></i> Seleccione Tipo de Ficha</H5>

            <div id="tipoficha" class="form-group col-md-12">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="ADSCRIPCION" v-model="TIPO_FICHA"
                           value="ADSCRIPCION" name="ADSCRIPCION">
                    <label class="required form-check-label font-weight-bold">&nbsp;&nbsp;Adscripción</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="AUTOGESTION" v-model="TIPO_FICHA"
                           value="AUTOGESTION" name="AUTOGESTION">
                    <label for="AUTOGESTION"
                           class="form-check-label font-weight-bold">&nbsp;&nbsp;Autogestión</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="CONTINUIDAD" v-model="TIPO_FICHA"
                           value="CONTINUIDAD" name="CONTINUIDAD">
                    <label for="CONTINUIDAD"
                           class="form-check-label font-weight-bold">&nbsp;&nbsp;Continuidad</label>
                </div>
            </div>
        <div class="row">
            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Información Educador(a) en formación </h5>
            <div class="form-group col-md-6">
                <label class="required">RUT</label>
                <input
                    type="text"
                    class="form-control"
                    ID="RUT_ESTUDIANTE"
                    name="RUT_ESTUDIANTE"
                    v-model="form.RUT_ESTUDIANTE"
                    placeholder="Ej: 9.999.999-9"
                    v-on:keyup="searchEstudiante"
                    v-validate="'required|max:100'"
                    data-vv-as="RUT_ESTUDIANTE"
                    :class="{'is-invalid': errors.has('RUT_ESTUDIANTE')}"
                />
                <div class="invalid-feedback">{{ errors.first('RUT_ESTUDIANTE') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Nombre Estudiante</label>
                <input
                    type="text"
                    class="form-control"
                    ID="NOMBRE_ESTUDIANTE"
                    name="NOMBRE_ESTUDIANTE"
                    v-model="form.NOMBRE_ESTUDIANTE"
                    placeholder="Ej: Antonio"

                    v-validate="'required|max:100'"
                    data-vv-as="NOMBRE_ESTUDIANTE"
                    :class="{'is-invalid': errors.has('RUT')}"
                />
                <div class="invalid-feedback">{{ errors.first('NOMBRE_ESTUDIANTE') }}</div>
            </div>
            <div class="form-group col-md-3">
                <label class="required">Email</label>
                <input
                    type="text"
                    class="form-control"
                    ID="EMAIL_ESTUDIANTE"
                    name="EMAIL_ESTUDIANTE"
                    v-model="form.EMAIL_ESTUDIANTE"
                    placeholder="Ej: ejemplo@email.com..."
                    v-validate="'required|max:100'"
                    data-vv-as="EMAIL_ESTUDIANTE"
                    :class="{'is-invalid': errors.has('EMAILEMAIL')}"
                />
                <div class="invalid-feedback">{{ errors.first('EMAIL_ESTUDIANTE') }}</div>
            </div>

            <div class="form-group col-md-3">
                <label class="required">Teléfono</label>
                <input
                    type="text"
                    class="form-control"
                    ID="TELEFONO_ESTUDIANTE"
                    name="TELEFONO_ESTUDIANTE"
                    v-model="form.TELEFONO_ESTUDIANTE"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="TELEFONO_ESTUDIANTE"
                    :class="{'is-invalid': errors.has('TELEFONO_ESTUDIANTE')}"
                />
                <div class="invalid-feedback">{{ errors.first('TELEFONO_ESTUDIANTE') }}</div>
            </div>

            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Información General </h5>
            <div class="form-group col-md-6">
                <label class="required">Año </label>

                <kendo-dropdownlist
                    :ref="'ANIO'"
                    class="form-control"
                    name="ANIO"
                    v-model="form.ANIO"
                    :data-source="dsAnio"
                    :data-text-field="'name'"
                    :data-value-field="'name'"
                    :optionLabel="'Seleccione'"
                    :filter="'contains'"
                    :class="{'is-invalid': errors.has('dsAnio')}"
                ></kendo-dropdownlist>

                <div class="invalid-feedback">{{ errors.first('ANIO') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Periodo </label>

                <kendo-dropdownlist
                    :ref="'PERIODO'"
                    class="form-control"
                    name="PERIODO"
                    v-model="form.PERIODO"
                    :data-source="dsPeriodo"
                    :data-text-field="'name'"
                    :data-value-field="'name'"
                    :optionLabel="'Seleccione'"
                    :filter="'contains'"
                    :class="{'is-invalid': errors.has('dsPeriodo')}"
                ></kendo-dropdownlist>

                <div class="invalid-feedback">{{ errors.first('PERIODO') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Carrera </label>

                <kendo-dropdownlist
                    :ref="'UA'"
                    class="form-control"
                    name="UA"
                    v-model="form.UA"
                    :data-source="dsCarrera"
                    :data-text-field="'CARRERA'"
                    :data-value-field="'UA'"
                    :optionLabel="'Seleccione'"
                    @select="selectCarrera"
                    :filter="'contains'"
                    :class="{'is-invalid': errors.has('dsCarrera')}"
                ></kendo-dropdownlist>

                <div class="invalid-feedback">{{ errors.first('UA') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Nivel Practica </label>

                <kendo-dropdownlist
                    :ref="'NIVEL_PRACTICA'"
                    class="form-control"
                    name="NIVEL_PRACTICA"
                    v-model="form.NIVEL_PRACTICA"
                    :data-source="dsNivelPractica"
                    :data-text-field="'name'"
                    :data-value-field="'name'"
                    :optionLabel="'Seleccione'"
                    :filter="'contains'"
                    :class="{'is-invalid': errors.has('dsNivelPractica')}"
                ></kendo-dropdownlist>

                <div class="invalid-feedback">{{ errors.first('NIVEL_PRACTICA') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Tipo Practica </label>

                <kendo-dropdownlist
                    :ref="'TIPO_PRACTICA'"
                    class="form-control"
                    name="TIPO_PRACTICA"
                    v-model="form.TIPO_PRACTICA"
                    :data-source="dsTipoPractica"
                    :data-text-field="'name'"
                    :data-value-field="'name'"
                    :optionLabel="'Seleccione'"
                    :filter="'contains'"
                    :class="{'is-invalid': errors.has('dsTipoPractica')}"
                ></kendo-dropdownlist>

                <div class="invalid-feedback">{{ errors.first('TIPO_PRACTICA') }}</div>
            </div>
            <hr>

            <div class="col-md-12" v-if="this.listaCupos && TIPO_FICHA!=='AUTOGESTION'" >
                <H5><i class="fa fa-angle-right" aria-hidden="true"></i> Cupos Disponibles</H5>
                <table class="table" v-if="this.dsCuposPracticas.length">
                    <thead>
                    <tr>
                        <th scope="col">RBD</th>
                        <th scope="col">Centro</th>
                        <th scope="col">Comuna</th>
                        <th scope="col">Nro.Integrantes por cupo</th>
                        <th scope="col">Nro.Integrantes actuales</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Seleccionar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr  v-for=" row in this.dsCuposPracticas" :key="row.ID_CUPOS_PROGRAMACION_PRACTICA">
                        <th scope="row">{{ row.RBD_CENTRO_PRACTICA }}</th>
                        <td>{{ row.NOMBRE_CENTRO_PRACTICA }}</td>
                        <td>{{ row.COMUNA_CENTRO_PRACTICA }}</td>
                        <td>{{ row.MODALIDAD }}</td>
                        <td>{{ row.N_INTEGRANTES_CUPOS_PRACTICA }}</td>
                        <td>{{ row.ESTADO }}</td>
                        <td><i class="fa fa-plus-square" aria-hidden="true" @click="SelectCupo(row.ID_CUPOS_PROGRAMACION_PRACTICA)"></i></td>
                    </tr>
                    </tbody>
                </table>

                    <span v-else> * No existen cupos con los parámetros ingresados</span>

                <div class="row ml-2 mb-2" v-if="this.form.ID_CUPOS_PROGRAMACION_PRACTICA!==null">
                    <h6 class="col-md-12"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Información del cupo seleccionado </h6>
                    <div class="col-md-3 mt-2">
                        <span><strong>RBD: </strong> {{this.form.INFO_CUPO.RBD_CENTRO_PRACTICA}}</span>
                    </div>
                    <div class="col-md-3 mt-2">
                        <span><strong>Nombre Centro: </strong>{{this.form.INFO_CUPO.NOMBRE_CENTRO_PRACTICA}}</span>
                    </div>
                    <div class="col-md-3 mt-2">
                        <span><strong>Comuna: </strong>{{this.form.INFO_CUPO.COMUNA_CENTRO_PRACTICA}}</span>
                    </div>
                    <div class="col-md-3 mt-2">
                        <span><strong>Modalidad: </strong>{{this.form.INFO_CUPO.MODALIDAD}}</span>
                    </div>
                    <div class="col-md-3 mt-2">
                        <span><strong>Dependencia Administrativa: </strong>{{this.form.INFO_CUPO.DEPENDENCIA_ADMINISTRATIVA_CENTRO_PRACTICA}}</span>
                    </div>
                    <div class="col-md-3 mt-2">
                        <span><strong>Cursos de intervencion: </strong>{{this.form.INFO_CUPO.CURSOS_INTERVENCION}}</span>
                    </div>
                    <div class="col-md-3 mt-2">
                        <span><strong>Nombre profesor Colaborador: </strong>{{this.form.INFO_CUPO.PROFESOR_COLABORADOR}}</span>
                    </div>
                    <div class="col-md-3 mt-2">
                        <span><strong>RUN profesor Colaborador: </strong>{{this.form.INFO_CUPO.RUT_PROFESOR_COLABORADOR}}</span>
                    </div>


                </div>
            </div>
            <template v-if="TIPO_FICHA=='AUTOGESTION'" >
                <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Información Centro de práctica </h5>
                <div class="form-group col-md-3">
                    <label class="required">RBD</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="RBD_CP"
                        name="RBD_CP"
                        v-model="form.RBD_CP"
                        placeholder=""
                        v-on:keyup="searchEstablecimiento"
                        v-validate="'required|max:100'"
                        data-vv-as="RBD"
                        :class="{'is-invalid': errors.has('RBD_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('RBD_CP') }}</div>
                </div>
                <div class="form-group col-md-9">
                    <label class="required">Nombre del Centro de Práctica</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="NOMBRE_CP"
                        name="NOMBRE_CP"
                        v-model="form.NOMBRE_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="NOMBRE_CP"
                        :class="{'is-invalid': errors.has('NOMBRE_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('NOMBRE_CP') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Región</label>
                    <kendo-dropdownlist
                        class="form-control"
                        name="REGION"
                        ID="REGION"
                        v-model="form.REGION_CP"
                        @select="getComunas"
                        :data-source="dsRegiones"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsRegiones')}"
                    ></kendo-dropdownlist>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Comuna</label>
                    <kendo-dropdownlist
                        :ref="'COMUNA_cp'"
                        class="form-control"
                        name="COMUNA_cp"
                        v-model="form.COMUNA_cp"
                        :data-source="dsComunas"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsComunas')}"
                    ></kendo-dropdownlist>
                </div>
                <div id="dependencia" class="form-group col-md-6">
                    <label class="required">Dependencia Administrativa</label><br>

                    <kendo-dropdownlist
                        :ref="'DEPENDENCIA_CP'"
                        class="form-control"
                        name="DEPENDENCIA_CP"
                        v-model="form.DEPENDENCIA_CP"
                        :data-source="dsDependencia"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsDependencia')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('DEPENDENCIA_CP') }}</div>

                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nivel Enseñanza</label><br>

                    <kendo-dropdownlist
                        :ref="'TIPO_ENSENANZA_CP'"
                        class="form-control"
                        name="TIPO_ENSENANZA_CP"
                        v-model="form.TIPO_ENSENANZA_CP"
                        :data-source="dsNivelEnsenanza"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsNivelEnsenanza')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('TIPO_ENSENANZA_CP') }}</div>
                </div>
                <h6 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Información del contacto </h6>
                <div class="form-group col-md-6">
                    <label class="required">Nombre del Director(a) / que valida la pasantía</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="DIRECTIVO_CP"
                        name="DIRECTIVO_CP"
                        v-model="form.DIRECTIVO_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="DIRECTIVO_CP"
                        :class="{'is-invalid': errors.has('DIRECTIVO_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('DIRECTIVO_CP') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Cargo directivo dentro de la institución:</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="CARGO_DIRECTIVO_CP"
                        name="CARGO_DIRECTIVO_CP"
                        v-model="form.CARGO_DIRECTIVO_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="CARGO_DIRECTIVO_CP"
                        :class="{'is-invalid': errors.has('CARGO_DIRECTIVO_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('CARGO_DIRECTIVO_CP') }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Teléfono Contacto</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="TELEFONO_CONTACTO_CP"
                        name="TELEFONO_CONTACTO_CP"
                        v-model="form.TELEFONO_CONTACTO_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="TELEFONO_CONTACTO_CP"
                        :class="{'is-invalid': errors.has('TELEFONO_CONTACTO_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('TELEFONO_CONTACTO_CP') }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Email Contacto</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="EMAIL_CONTACTO_CP"
                        name="EMAIL_CONTACTO_CP"
                        v-model="form.EMAIL_CONTACTO_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="EMAIL_CONTACTO_CP"
                        :class="{'is-invalid': errors.has('EMAIL_CONTACTO_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('TELEFONO_CP') }}</div>
                </div>
                <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Información del Cupo</h5>
                <div class="form-group col-md-6">
                    <label class="required">Modalidad Practica</label>

                    <kendo-dropdownlist
                        :ref="'MODALIDAD_PRACTICA_CUPO'"
                        class="form-control"
                        name="MODALIDAD_PRACTICA_CUPO"
                        v-model="form.MODALIDAD_PRACTICA_CUPO"
                        :data-source="dsModalidadPractica"
                        :data-text-field="'name'"
                        :data-value-field="'value'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsModalidadPractica')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('MODALIDAD_PRACTICA_CUPO') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Cursos de intervención </label>

                    <kendo-multiselect
                        :ref="'CURSO_INTERVENCION_CUPO'"
                        class="form-control"
                        name="CURSO_INTERVENCION_CUPO"
                        v-model="form.CURSO_INTERVENCION_CUPO"
                        :data-source="dsCursoIntervencion"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsCursoIntervencion')}"
                    ></kendo-multiselect>

                    <div class="invalid-feedback">{{ errors.first('CURSO_INTERVENCION_CUPO') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nombre Educador(a) o Profesor(a) Colaborador(a) Centro de Práctica</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="NOMBRE_PROF_COLABORADOR_CP"
                        name="NOMBRE_PROF_COLABORADOR_CP"
                        v-model="form.NOMBRE_PROF_COLABORADOR_CUPO"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="NOMBRE_PROF_COLABORADOR_CP"
                        :class="{'is-invalid': errors.has('NOMBRE_PROF_COLABORADOR_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('NOMBRE_PROF_COLABORADOR_CP') }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Email Profesor(a) Colaborador(a) Centro de práctica </label>
                    <input
                        type="text"
                        class="form-control"
                        ID="EMAIL_PROF_COLABORADOR_CP"
                        name="EMAIL_PROF_COLABORADOR_CP"
                        v-model="form.EMAIL_PROF_COLABORADOR_CUPO"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="EMAIL_PROF_COLABORADOR_CP"
                        :class="{'is-invalid': errors.has('EMAIL_PROF_COLABORADOR_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('EMAIL_PROF_COLABORADOR_CP') }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Función dentro de la institución </label>
                    <input
                        type="text"
                        class="form-control"
                        ID="FUNCION_PROF_COLABORADOR_CP"
                        name="FUNCION_PROF_COLABORADOR_CP"
                        v-model="form.FUNCION_PROF_COLABORADOR_CUPO"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="FUNCION_PROF_COLABORADOR_CP"
                        :class="{'is-invalid': errors.has('FUNCION_PROF_COLABORADOR_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('FUNCION_PROF_COLABORADOR_CP') }}</div>
                </div>
            </template>
            <template v-if="TIPO_FICHA=='CONTINUIDAD'">
                <br>
                <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Información de la Continuidad </h5>
                <div class="form-group col-md-4">
                    <label class="required">Cantidad de veces que el estudiante ha realizado práctica en el
                        establecimiento</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="CANTIDAD_VECES"
                        name="CANTIDAD_VECES"
                        v-model="form.CANTIDAD_VECES"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="TELEFONO_CP"
                        :class="{'is-invalid': errors.has('CANTIDAD_VECES')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('CANTIDAD_VECES') }}</div>
                </div>

                <div id="exalumno" class="form-group col-md-2">
                    <label class="required">Ex alumno establecimiento</label><br>

                    <kendo-dropdownlist
                        :ref="'EX_ALUMNO_ESTABLECIMIENTO'"
                        class="form-control"
                        name="EX_ALUMNO_ESTABLECIMIENTO"
                        v-model="form.EX_ALUMNO_ESTABLECIMIENTO"
                        :data-source="dsExAlumno"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsDependencia')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('EX_ALUMNO_ESTABLECIMIENTO') }}</div>
                </div>

                <div class="form-group col-md-6">
                    <label class="required">Razones para solicitar continuidad</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="RAZON_CONTINUIDAD"
                        name="RAZON_CONTINUIDAD"
                        v-model="form.RAZON_CONTINUIDAD"
                        placeholder="Por ..."
                        v-validate="'required|max:100'"
                        data-vv-as="RAZON_CONTINUIDAD"
                        :class="{'is-invalid': errors.has('RAZON_CONTINUIDAD')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('RAZON_CONTINUIDAD') }}</div>
                </div>
            </template>
            <h6 class="col-md-12 mt-1"><i class="fa fa-angle-right" aria-hidden="true"></i> Observación</h6>
            <div class="col-md-12 mt-2">
                <editor :resizable-content="true"
                        :resizable-toolbar="true"
                        :value="htmlText"
                        style="height:80px"
                        rows="10"
                        cols="30"
                        :pdf="pdf"
                        v-model="form.OBSERVACION"

                >
                    <!--                    <editor-tool :name="'fontName'"></editor-tool>-->
                    <editor-tool :name="'fontSize'"></editor-tool>

                    <editor-tool :name="'bold'"></editor-tool>
                    <editor-tool :name="'italic'"></editor-tool>
                    <editor-tool :name="'underline'"></editor-tool>

                    <editor-tool :name="'insertUnorderedList'"></editor-tool>
                    <editor-tool :name="'insertOrderedList'"></editor-tool>
                    <editor-tool :name="'indent'"></editor-tool>
                    <editor-tool :name="'outdent'"></editor-tool>

                    <editor-tool :name="'justifyLeft'"></editor-tool>
                    <editor-tool :name="'justifyCenter'"></editor-tool>
                    <editor-tool :name="'justifyRight'"></editor-tool>
                    <editor-tool :name="'justifyFull'"></editor-tool>

                    <editor-tool :name="'viewHtml'"></editor-tool>
                    <editor-tool :name="'pdf'"></editor-tool>

                </editor>
                <br>
            </div>
        </div>
            <button type="submit" class="btn btn-primary float-right" :disabled="submit">
                <i
                    class="fa"
                    :class="{'fa-floppy-o': !submit, 'fa-spinner fa-spin': submit}"
                    aria-hidden="true"
                ></i>
                Guardar
            </button>
      </form>
    </div>
</template>

<script>


import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";

import Urls from "../../../common/json/Urls.json";
import eventHub from "../../../../eventHub";
import TipoPractica from "../../../common/json/TipoPractica.json";
import Periodos from "../../../common/json/Periodos.json";
import NivelesPractica from "../../../common/json/NivelesPractica.json";
import Anios from "../../../common/json/Anios.json";
import AlertMessage from "../../../common/json/AlertMessage.json";
import DependenciaAdministrativa from "../../../common/json/DependenciaAdministrativa.json";
import Communes from "../../../common/json/Communes.json";
import Regions from "../../../common/json/Regions.json";
import NivelEnsenanza from "../../../common/json/NivelEnsenanza.json";
import Modalidad from "../../../common/json/Modalidad.json";
import CursosIntervencion from "../../../common/json/CursosIntervencion.json";
import SiNo from "../../../common/json/SiNo.json";
import { Editor, EditorTool } from '@progress/kendo-editor-vue-wrapper';

export default {
    components: {
        Editor,
        EditorTool,
        MultiSelect,
        DateInput
    },
    data: function () {
        return {
            submit: false,
            dsCarrera: [],
            dsPeriodo: [],
            dsCuposPracticas: [],
            dsNivelPractica: [],
            dsTipoPractica: [],
            dsAnio: [],
            dsExAlumno:[],
            dsDependencia: [],
            dsComunas: [],
            dsRegiones: [],
            dsNivelEnsenanza:[],
            dsModalidadPractica:[],
            listaCupos: true,
            TIPO_FICHA: "ADSCRIPCION",
            propsToPass: {
                titulo: "Ficha Practica",
                ayuda: "lorem ",
                element: "FICHA_PRACTICA",
            },
            pdf: {
                fileName: "Export.pdf",
                proxyURL: "https://demos.telerik.com/kendo-ui/service/export",
                paperSize: "a4",
                margin: {
                    bottom: 20,
                    left: 25,
                    right: 25,
                    top: 20
                }
            },
            htmlText:'<p>Escribir aquí...</p>'
        }

    },
    computed: {
        form() {
            return this.$store.state.ficha;
        },
    },
    created: function () {
        this.getPeriodos();
        this.getNivelPractica();
        this.getCarreras();
        this.getTipoPractica();
        this.getAnio();
        this.getDependencia();
        this.getNivelEnsenanza();
        this.getRegion();
        this.getCursosIntervencion();
        this.getModalidad();
        this.getExAlumno();
    },
    methods: {
        getExAlumno(){
            this.dsExAlumno=SiNo.SiNo;
        },
        getModalidad(){
            this.dsModalidadPractica=Modalidad.Modalidad;

        },
        getCursosIntervencion(){
            this.dsCursoIntervencion=CursosIntervencion.CursosIntervencion;

        },
        getNivelEnsenanza(){
            this.dsNivelEnsenanza=NivelEnsenanza.NivelEnsenanza;
        },
        getRegion() {
            this.dsRegiones = Regions["regions"];
            this.dsComunas = Communes.communes;
        },
        getDependencia() {
            this.dsDependencia = DependenciaAdministrativa.DependenciaAdministrativa;
        },
        getComunas(value) {
            this.dsComunas = value.dataItem.communes;
        },
        getTipoPractica() {
            this.dsTipoPractica = TipoPractica.TipoPractica;

        },
        getPeriodos() {
            this.dsPeriodo = Periodos.Periodos;
        },
        getNivelPractica() {
            this.dsNivelPractica = NivelesPractica.NivelesPractica;
        },
        getAnio() {
            this.dsAnio = Anios.Anios;

        },
        selectCarrera(value) {
            console.log(value);
            this.form.CARRERA = value.dataItem.CARRERA
            console.log(this.form.CARRERA);
        },
        resetForm() {
            this.form.ID = 0;
            this.form.CARRERA = null;
            this.form.NOMBRE = null;
            this.form.EDITAR_FORMULARIO = false;
        },
        validate() {
            this.$validator.validate().then((results) => {
                if (results) this.saveForm();
                else {
                    toastr.error(
                        AlertMessage.FORMULARIO.VALIDATE_ERROR
                    );
                }
            });
        },
        SelectCupo(id){
            console.log("ID: "+id);
            let index =  this.dsCuposPracticas.find(el => el.ID_CUPOS_PROGRAMACION_PRACTICA === id);
            console.log(index);
            this.form.ID_CUPOS_PROGRAMACION_PRACTICA=index.ID_CUPOS_PROGRAMACION_PRACTICA;
            this.form.INFO_CUPO=index;
        },
        searchEstudiante() {
            var keyword = this.form.RUT;

            if (keyword != null && keyword.length > 7) {
                //traer informacion del estudiante
                //console.log(keyword);
                console.log('traer informacion del estudiante');
                this.getEstudiante(keyword)
            }
        },
        getEstudiante(id) {
            let url = Urls["ESTUDIANTES"].GET + id;
            axios
                .get(url, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    console.log(response.data.data);


                    if (response.data.data.length > 0) {
                        this.form.NOMBRE = response.data.data[0].NOMBRE + " " + response.data.data[0].APELLIDO;
                        this.form.EMAIL = response.data.data[0].EMAIL;
                        this.form.CARRERA = response.data.data[0].UA;
                        this.form.DIRECCION = response.data.data[0].DIRECCION;
                        this.form.TELEFONO = response.data.data[0].TELEFONO;
                        this.form.COMUNA = response.data.data[0].COMUNA;


                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    eventHub.$emit("LoadingOff",{obj:false});

                });
        },
        getCarreras() {
            let url = Urls["CARRERAS"].GET_ALL;
            axios
                .get(url, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    //console.log(response.data.data);
                    if (response.data.data.length > 0) {
                        this.dsCarrera = response.data.data;
                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    eventHub.$emit("LoadingOff",{obj:false});

                });

        },

        searchEstablecimiento() {
            var keyword = this.form.RBD;
            console.log(keyword);
            if (keyword != null && keyword.length > 3) {
                //traer informacion del CENTRO PRACTICA
                console.log(keyword);
                console.log('traer informacion del Centro de práctica');
                this.getEstablecimiento(keyword)
            }
        },
        getEstablecimiento(id) {
            let url = Urls["CENTRO_PRACTICAS"].GET_RBD + id;
            axios
                .get(url, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    // console.log(response.data.data);

                    if (response.data.data.length > 0) {

                        console.log(response);
                        this.form.CENTRO_PRACTICA = response.data.data[0].NOMBRE_ESTABLECIMIENTO;
                        this.form.DEPENDENCIA = response.data.data[0].DEPENDENCIA_ADMINISTRATIVA;
                        this.form.ENSENANZA = response.data.data[0].TIPO_ENSENANZA;
                        this.form.DIRECCION_CP = response.data.data[0].DIRECCION;
                        this.form.TELEFONO_CP = response.data.data[0].TELEFONO;
                        this.form.COMUNA_CP = response.data.data[0].COMUNA;
                        this.form.DIRECTOR_CP = response.data.data[0].NOMBRE_DIRECTOR;
                        this.form.EMAIL_DIRECTOR_CP = response.data.data[0].EMAIL_DIRECTOR;
                        this.form.NOMBRE_UTP_CP = response.data.data[0].NOMBRE_JEFE_UTP;
                        this.form.EMAIL_UTP_CP = response.data.data[0].EMAIL_JEFE_UTP;
                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    eventHub.$emit("LoadingOff",{obj:false});

                });
        },
        getCuposProgramacionPractica() {
            console.log("buscadnocupos");
            let url = Urls["CUPOS_PROGRAMACION_PRACTICA"].GET_CUPOS_PROGRAMACION_PRACTICA;
            let formData = new FormData();
            formData.append("ANIO", this.form.ANIO);
            formData.append("PERIODO", this.form.PERIODO);
            formData.append("UA", this.form.UA);
            formData.append("CARRERA", this.form.CARRERA);
            formData.append("TIPO_PRACTICA", this.form.TIPO_PRACTICA);
            formData.append("NIVEL_PRACTICA", this.form.NIVEL_PRACTICA);

            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    if (response.data.data.length > 0) {


                        this.dsCuposPracticas = response.data.data;
                        this.listaCupos = true;
                    }
                })
                .catch(function (error) {
                    //this.loading = false;
                    toastr.error(
                        AlertMessage.FORMULARIO.SAVE_ERROR
                    );
                    console.log("ERROR:", error);
                    onError();
                });

        },
        saveForm() {
            this.form.TIPO_FICHA=this.TIPO_FICHA;
            eventHub.$emit("LoadingOff",{obj:true});

            let url = Urls[this.propsToPass.element].SAVE;
            let formData = new FormData();

            formData.append("ID", this.form.ID);
            formData.append("TIPO_FICHA", this.form.TIPO_FICHA);
            formData.append("RUT_ESTUDIANTE", this.form.RUT_ESTUDIANTE);
            formData.append("NOMBRE_ESTUDIANTE", this.form.NOMBRE_ESTUDIANTE);
            formData.append("EMAIL_ESTUDIANTE", this.form.EMAIL_ESTUDIANTE);
            formData.append("TELEFONO_ESTUDIANTE", this.form.TELEFONO_ESTUDIANTE);
            formData.append("ANIO", this.form.ANIO);
            formData.append("PERIODO", this.form.PERIODO);
            formData.append("CARRERA", this.form.CARRERA);
            formData.append("UA", this.form.UA);
            formData.append("NIVEL_PRACTICA", this.form.NIVEL_PRACTICA);
            formData.append("TIPO_PRACTICA", this.form.TIPO_PRACTICA);
            formData.append("ID_CUPOS_PROGRAMACION_PRACTICA", this.form.ID_CUPOS_PROGRAMACION_PRACTICA);
            formData.append("CANTIDAD_VECES", this.form.CANTIDAD_VECES);
            formData.append("EX_ALUMNO_ESTABLECIMIENTO", this.form.EX_ALUMNO_ESTABLECIMIENTO);
            formData.append("RAZON_CONTINUIDAD", this.form.RAZON_CONTINUIDAD);
            formData.append("RBD_CP", this.form.RBD_CP);
            formData.append("NOMBRE_CP", this.form.NOMBRE_CP);
            formData.append("COMUNA_CP", this.form.COMUNA_CP);
            formData.append("REGION_CP", this.form.REGION_CP);
            formData.append("DEPENDENCIA_CP", this.form.DEPENDENCIA_CP);
            formData.append("TIPO_ENSENANZA_CP", this.form.TIPO_ENSENANZA_CP);
            formData.append("DIRECTIVO_CP", this.form.DIRECTIVO_CP);
            formData.append("CARGO_DIRECTIVO_CP", this.form.CARGO_DIRECTIVO_CP);
            formData.append("TELEFONO_CONTACTO_CP", this.form.TELEFONO_CONTACTO_CP);
            formData.append("EMAIL_CONTACTO_CP", this.form.EMAIL_CONTACTO_CP);
            formData.append("MODALIDAD_PRACTICA_CUPO", this.form.MODALIDAD_PRACTICA_CUPO);
            formData.append("CURSO_INTERVENCION_CUPO", this.form.CURSO_INTERVENCION_CUPO);
            formData.append("NOMBRE_PROF_COLABORADOR_CUPO", this.form.NOMBRE_PROF_COLABORADOR_CUPO);
            formData.append("EMAIL_PROF_COLABORADOR_CUPO", this.form.EMAIL_PROF_COLABORADOR_CUPO);
            formData.append("FUNCION_PROF_COLABORADOR_CUPO", this.form.FUNCION_PROF_COLABORADOR_CUPO);
            formData.append("INFO_CUPO", JSON.stringify(this.form.INFO_CUPO));
            formData.append("OBSERVACION", this.form.OBSERVACION);

            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    this.submit = false;

                    if (response.status) {
                        this.form.ID = response.data.data.id;

                        console.log("axios");
                        console.log(response);
                        toastr.success(AlertMessage.FORMULARIO.SAVE_EXITO);
                        eventHub.$emit( "updateToGrid",
                            {obj: this.form}
                        );
                        eventHub.$emit("LoadingOff",{obj:false});
                        eventHub.$emit("closeKendoWindows");
                    }

                })
                .catch(function (error) {
                    // this.loading = false;
                    toastr.error(
                        AlertMessage.FORMULARIO.SAVE_ERROR
                    );
                    console.log("ERROR:", error);
                    onError();
                });
        }
    },
    watch: {
        'form.PERIODO': function () {
            //console.log(this.form.PERIODO);
            if (this.form.PERIODO != null && this.form.ANIO != null && this.form.CARRERA != null && this.form.NIVEL_PRACTICA != null && this.form.TIPO_PRACTICA != null) {

                this.getCuposProgramacionPractica();
            }
        },
        'form.ANIO': function () {
            // console.log(this.form.ANIO);
            if (this.form.PERIODO != null && this.form.ANIO != null && this.form.CARRERA != null && this.form.NIVEL_PRACTICA != null && this.form.TIPO_PRACTICA != null) {

                this.getCuposProgramacionPractica();
            }
        },
        'form.UA': function () {
            //console.log(this.form.UA);
            if (this.form.PERIODO != null && this.form.ANIO != null && this.form.CARRERA != null && this.form.NIVEL_PRACTICA != null && this.form.TIPO_PRACTICA != null) {

                this.getCuposProgramacionPractica();
               // this.getAsignaturasByUa(this.form.UA, true);
            }
        },
        'form.NIVEL_PRACTICA': function () {
            //console.log(this.form.NIVEL_PRACTICA);
            if (this.form.PERIODO != null && this.form.ANIO != null && this.form.CARRERA != null && this.form.NIVEL_PRACTICA != null && this.form.TIPO_PRACTICA != null) {

                this.getCuposProgramacionPractica();
            }
        },
        'form.TIPO_PRACTICA': function () {
            // console.log(this.form.TIPO_PRACTICA);
            console.log(this.form.PERIODO);
            console.log(this.form.TIPO_PRACTICA);
            console.log(this.form.NIVEL_PRACTICA);
            console.log(this.form.UA);
            console.log(this.form.PERIODO);
            if (this.form.PERIODO != null && this.form.ANIO != null && this.form.CARRERA != null && this.form.NIVEL_PRACTICA != null && this.form.TIPO_PRACTICA != null) {

                this.getCuposProgramacionPractica();
            }
        }
    }
}
</script>

<style scoped>

</style>
