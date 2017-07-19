app.controller("controllerLaboratorio", function ($scope, $http, API_URL)
{

  //Como inician los campos

  $scope.init = function ()
  {
    $scope.id_medico = "{{($operation == 'update')?$laboratorio->id_medico :''}}";
    $scope.id_paciente = "{{($operation == 'update')?$laboratorio->id_paciente :''}}";
    $scope.fecha = "{{($operation == 'update')?$laboratorio->fecha :''}}";
    $scope.bio_h = "{{($operation == 'update')?$laboratorio->bio_h :''}}";
    $scope.hto_hb = "{{($operation == 'update')?$laboratorio->hto_hb :''}}";
    $scope.reticulocitos = "{{($operation == 'update')?$laboratorio->reticulocitos :''}}";
    $scope.sedimentacion_ves = "{{($operation == 'update')?$laboratorio->sedimentacion_ves :''}}";
    $scope.formula_leuco = "{{($operation == 'update')?$laboratorio->formula_leuco :''}}";
    $scope.plaquetas = "{{($operation == 'update')?$laboratorio->plaquetas :''}}";
    $scope.grupo_sanguineo = "{{($operation == 'update')?$laboratorio->grupo_sanguineo :''}}";
    $scope.elemental_microscopico = "{{($operation == 'update')?$laboratorio->elemental_microscopico :''}}";
    $scope.gota_fresca = "{{($operation == 'update')?$laboratorio->gota_fresca :''}}";
    $scope.gram_o = "{{($operation == 'update')?$laboratorio->gram_o :''}}";
    $scope.microalbuminuria = "{{($operation == 'update')?$laboratorio->microalbuminuria :''}}";
    $scope.proteinuria24 = "{{($operation == 'update')?$laboratorio->proteinuria24 :''}}";
    $scope.depuracion_creatinina = "{{($operation == 'update')?$laboratorio->depuracion_creatinina :''}}";
    $scope.sodio = "{{($operation == 'update')?$laboratorio->sodio :''}}";
    $scope.potasio = "{{($operation == 'update')?$laboratorio->potasio :''}}";
    $scope.cloro = "{{($operation == 'update')?$laboratorio->cloro :''}}";
    $scope.ac_urico = "{{($operation == 'update')?$laboratorio->ac_urico :''}}";
    $scope.calcio = "{{($operation == 'update')?$laboratorio->calcio :''}}";
    $scope.fosforo = "{{($operation == 'update')?$laboratorio->fosforo :''}}";
    $scope.magnesio = "{{($operation == 'update')?$laboratorio->magnesio :''}}";
    $scope.prueba_embarazo = "{{($operation == 'update')?$laboratorio->prueba_embarazo :''}}";
    $scope.panel_drogas = "{{($operation == 'update')?$laboratorio->panel_drogas :''}}";
    $scope.asto_cuantitativo = "{{($operation == 'update')?$laboratorio->asto_cuantitativo :''}}";
    $scope.pcr_cualitativo = "{{($operation == 'update')?$laboratorio->pcr_cualitativo :''}}";
    $scope.latex = "{{($operation == 'update')?$laboratorio->latex :''}}";
    $scope.vdrl = "{{($operation == 'update')?$laboratorio->vdrl :''}}";
    $scope.aglutinaciones_febriles = "{{($operation == 'update')?$laboratorio->aglutinaciones_febriles :''}}";
    $scope.helicobacter_pylori = "{{($operation == 'update')?$laboratorio->helicobacter_pylori :''}}";
    $scope.peptido_citrulinado = "{{($operation == 'update')?$laboratorio->peptido_citrulinado :''}}";
    $scope.anti_citrulina = "{{($operation == 'update')?$laboratorio->anti_citrulina :''}}";
    $scope.tp = "{{($operation == 'update')?$laboratorio->tp :''}}";
    $scope.ttp = "{{($operation == 'update')?$laboratorio->ttp :''}}";
    $scope.tiempo_trombina = "{{($operation == 'update')?$laboratorio->tiempo_trombina :''}}";
    $scope.inr = "{{($operation == 'update')?$laboratorio->inr :''}}";
    $scope.tiempo_coagulacion = "{{($operation == 'update')?$laboratorio->tiempo_coagulacion :''}}";
    $scope.fibrinogeno = "{{($operation == 'update')?$laboratorio->fibrinogeno :''}}";
    $scope.tiempo_hemorragia = "{{($operation == 'update')?$laboratorio->tiempo_hemorragia :''}}";
    $scope.antitrombina_iii = "{{($operation == 'update')?$laboratorio->antitrombina_iii :''}}";
    $scope.coombs_directo = "{{($operation == 'update')?$laboratorio->coombs_directo :''}}";
    $scope.coombs_indirecto = "{{($operation == 'update')?$laboratorio->coombs_indirecto :''}}";
    $scope.retraccion_coagulo = "{{($operation == 'update')?$laboratorio->retraccion_coagulo :''}}";
    $scope.anti_toxoplasma = "{{($operation == 'update')?$laboratorio->anti_toxoplasma :''}}";
    $scope.igg_anti_toxoplasma = "{{($operation == 'update')?$laboratorio->igg_anti_toxoplasma :''}}";
    $scope.igm_anti_toxoplasma = "{{($operation == 'update')?$laboratorio->igm_anti_toxoplasma :''}}";
    $scope.anti_rubeola = "{{($operation == 'update')?$laboratorio->anti_rubeola :''}}";
    $scope.igg_anti_rubeola = "{{($operation == 'update')?$laboratorio->igg_anti_rubeola :''}}";
    $scope.igm_anti_rubeola = "{{($operation == 'update')?$laboratorio->igm_anti_rubeola :''}}";
    $scope.anti_cmv = "{{($operation == 'update')?$laboratorio->anti_cmv :''}}";
    $scope.igg_anti_cmv = "{{($operation == 'update')?$laboratorio->igg_anti_cmv :''}}";
    $scope.igm_anti_cmv = "{{($operation == 'update')?$laboratorio->igm_anti_cmv :''}}";
    $scope.anti_herpes_i = "{{($operation == 'update')?$laboratorio->anti_herpes_i :''}}";
    $scope.igg_anti_herpes_i = "{{($operation == 'update')?$laboratorio->igg_anti_herpes_i :''}}";
    $scope.igm_anti_herpes_i = "{{($operation == 'update')?$laboratorio->igm_anti_herpes_i :''}}";
    $scope.anti_herpes_ii = "{{($operation == 'update')?$laboratorio->anti_herpes_ii :''}}";
    $scope.igg_anti_herpes_ii = "{{($operation == 'update')?$laboratorio->igg_anti_herpes_ii :''}}";
    $scope.igm_anti_herpes_ii = "{{($operation == 'update')?$laboratorio->igm_anti_herpes_ii :''}}";
    $scope.torch = "{{($operation == 'update')?$laboratorio->torch :''}}";
    $scope.igg_torch = "{{($operation == 'update')?$laboratorio->igg_torch :''}}";
    $scope.igm_torch = "{{($operation == 'update')?$laboratorio->igm_torch :''}}";
    $scope.c3 = "{{($operation == 'update')?$laboratorio->c3 :''}}";
    $scope.c4 = "{{($operation == 'update')?$laboratorio->c4 :''}}";
    $scope.igm = "{{($operation == 'update')?$laboratorio->igm :''}}";
    $scope.ige = "{{($operation == 'update')?$laboratorio->ige :''}}";
    $scope.iga = "{{($operation == 'update')?$laboratorio->iga :''}}";
    $scope.igd = "{{($operation == 'update')?$laboratorio->igd :''}}";
    $scope.igg = "{{($operation == 'update')?$laboratorio->igg :''}}";
    $scope.chlamidia = "{{($operation == 'update')?$laboratorio->chlamidia :''}}";
    $scope.igg_chlamidia = "{{($operation == 'update')?$laboratorio->igg_chlamidia :''}}";
    $scope.igm_chlamidia = "{{($operation == 'update')?$laboratorio->igm_chlamidia :''}}";
    $scope.iga_chlamidia = "{{($operation == 'update')?$laboratorio->iga_chlamidia :''}}";
    $scope.hepatitis_a = "{{($operation == 'update')?$laboratorio->hepatitis_a :''}}";
    $scope.igg_hepatitis_a = "{{($operation == 'update')?$laboratorio->igg_hepatitis_a :''}}";
    $scope.igm_hepatitis_a = "{{($operation == 'update')?$laboratorio->igm_hepatitis_a :''}}";
    $scope.hepatitis_b = "{{($operation == 'update')?$laboratorio->hepatitis_b :''}}";
    $scope.hbsag_hepatitis_b = "{{($operation == 'update')?$laboratorio->hbsag_hepatitis_b :''}}";
    $scope.anti_hbs_hepatitis_b = "{{($operation == 'update')?$laboratorio->anti_hbs_hepatitis_b :''}}";
    $scope.hbc_hepatitis_b = "{{($operation == 'update')?$laboratorio->hbc_hepatitis_b :''}}";
    $scope.igg_hepatitis_b = "{{($operation == 'update')?$laboratorio->igg_hepatitis_b :''}}";
    $scope.igm_hepatitis_b = "{{($operation == 'update')?$laboratorio->igm_hepatitis_b :''}}";
    $scope.hbeag_hepatitis_b = "{{($operation == 'update')?$laboratorio->hbeag_hepatitis_b :''}}";
    $scope.anti_hbe_hepatitis_b = "{{($operation == 'update')?$laboratorio->anti_hbe_hepatitis_b :''}}";
    $scope.hepatitis_c = "{{($operation == 'update')?$laboratorio->hepatitis_c :''}}";
    $scope.tuberculosis_suero = "{{($operation == 'update')?$laboratorio->tuberculosis_suero :''}}";
    $scope.ac_antinucleares = "{{($operation == 'update')?$laboratorio->ac_antinucleares :''}}";
    $scope.ac_anti_dna = "{{($operation == 'update')?$laboratorio->ac_anti_dna :''}}";
    $scope.celulas_le = "{{($operation == 'update')?$laboratorio->celulas_le :''}}";
    $scope.anticitrulina_anti_ccp = "{{($operation == 'update')?$laboratorio->anticitrulina_anti_ccp :''}}";
    $scope.ac_antimicrosomales = "{{($operation == 'update')?$laboratorio->ac_antimicrosomales :''}}";
    $scope.ac_antitiroglobulinas = "{{($operation == 'update')?$laboratorio->ac_antitiroglobulinas :''}}";
    $scope.ana_biot = "{{($operation == 'update')?$laboratorio->ana_biot :''}}";
    $scope.antifosfolipidos = "{{($operation == 'update')?$laboratorio->antifosfolipidos :''}}";
    $scope.autoinmunidad_igg  = "{{($operation == 'update')?$laboratorio->autoinmunidad_igg  :''}}";
    $scope.igm_antifosfolipidos = "{{($operation == 'update')?$laboratorio->igm_antifosfolipidos :''}}";
    $scope.anticardiolipinas = "{{($operation == 'update')?$laboratorio->anticardiolipinas :''}}";
    $scope.igg_anticardiolipinas = "{{($operation == 'update')?$laboratorio->igg_anticardiolipinas :''}}";
    $scope.igm_anticardiolipinas = "{{($operation == 'update')?$laboratorio->igm_anticardiolipinas :''}}";
    $scope.anti_b2gp1 = "{{($operation == 'update')?$laboratorio->anti_b2gp1 :''}}";
    $scope.ancas = "{{($operation == 'update')?$laboratorio->ancas :''}}";
    $scope.anti_mitocondriales = "{{($operation == 'update')?$laboratorio->anti_mitocondriales :''}}";
    $scope.quimica_sanguinea_glu_ayuna = "{{($operation == 'update')?$laboratorio->quimica_sanguinea_glu_ayuna :''}}";
    $scope.quimica_sanguinea_glu2h_post_p = "{{($operation == 'update')?$laboratorio->quimica_sanguinea_glu2h_post_p :''}}";
    $scope.curva_glucosa = "{{($operation == 'update')?$laboratorio->curva_glucosa :''}}";
    $scope.fructosamina = "{{($operation == 'update')?$laboratorio->fructosamina :''}}";
    $scope.urea_q = "{{($operation == 'update')?$laboratorio->urea_q :''}}";
    $scope.creatinina_q = "{{($operation == 'update')?$laboratorio->creatinina_q :''}}";
    $scope.bun = "{{($operation == 'update')?$laboratorio->bun :''}}";
    $scope.acido_urico = "{{($operation == 'update')?$laboratorio->acido_urico :''}}";
    $scope.colesterol = "{{($operation == 'update')?$laboratorio->colesterol :''}}";
    $scope.hdl_colesterol = "{{($operation == 'update')?$laboratorio->hdl_colesterol :''}}";
    $scope.ldl_colesterol = "{{($operation == 'update')?$laboratorio->ldl_colesterol :''}}";
    $scope.trigliceridos_q = "{{($operation == 'update')?$laboratorio->trigliceridos_q :''}}";
    $scope.apolipoproteina_a = "{{($operation == 'update')?$laboratorio->apolipoproteina_a :''}}";
    $scope.apolipoproteina_b = "{{($operation == 'update')?$laboratorio->apolipoproteina_b :''}}";
    $scope.vldl = "{{($operation == 'update')?$laboratorio->vldl :''}}";
    $scope.bilirrubinas_total = "{{($operation == 'update')?$laboratorio->bilirrubinas_total :''}}";
    $scope.proteinas_totales = "{{($operation == 'update')?$laboratorio->proteinas_totales :''}}";
    $scope.albumina = "{{($operation == 'update')?$laboratorio->albumina :''}}";
    $scope.globulina = "{{($operation == 'update')?$laboratorio->globulina :''}}";
    $scope.hb_glicosilada = "{{($operation == 'update')?$laboratorio->hb_glicosilada :''}}";
    $scope.hierro_serico = "{{($operation == 'update')?$laboratorio->hierro_serico :''}}";
    $scope.hierro_captacion_fijacion = "{{($operation == 'update')?$laboratorio->hierro_captacion_fijacion :''}}";
    $scope.vit_b12 = "{{($operation == 'update')?$laboratorio->vit_b12 :''}}";
    $scope.transferrina = "{{($operation == 'update')?$laboratorio->transferrina :''}}";
    $scope.ferritina_q = "{{($operation == 'update')?$laboratorio->ferritina_q :''}}";
    $scope.ac_folico = "{{($operation == 'update')?$laboratorio->ac_folico :''}}";
    $scope.ins_saturacion = "{{($operation == 'update')?$laboratorio->ins_saturacion :''}}";
    $scope.quimica_sanguinea_tgo_ast = "{{($operation == 'update')?$laboratorio->quimica_sanguinea_tgo_ast :''}}";
    $scope.tgp_alt = "{{($operation == 'update')?$laboratorio->tgp_alt :''}}";
    $scope.cpk = "{{($operation == 'update')?$laboratorio->cpk :''}}";
    $scope.cpk_mb = "{{($operation == 'update')?$laboratorio->cpk_mb :''}}";
    $scope.quimica_sanguinea_gamma_gt = "{{($operation == 'update')?$laboratorio->quimica_sanguinea_gamma_gt :''}}";
    $scope.troponina = "{{($operation == 'update')?$laboratorio->troponina :''}}";
    $scope.quimica_sanguinea_fosfatasa_alcalina = "{{($operation == 'update')?$laboratorio->quimica_sanguinea_fosfatasa_alcalina :''}}";
    $scope.aldolasa = "{{($operation == 'update')?$laboratorio->aldolasa :''}}";
    $scope.fosfatasa_acida = "{{($operation == 'update')?$laboratorio->fosfatasa_acida :''}}";
    $scope.fost_ac_prostatica = "{{($operation == 'update')?$laboratorio->fost_ac_prostatica :''}}";
    $scope.amilasa = "{{($operation == 'update')?$laboratorio->amilasa :''}}";
    $scope.lipasa = "{{($operation == 'update')?$laboratorio->lipasa :''}}";
    $scope.glucosa_6_fosfato_dh = "{{($operation == 'update')?$laboratorio->glucosa_6_fosfato_dh :''}}";
    $scope.deshidrogenasa_lactica = "{{($operation == 'update')?$laboratorio->deshidrogenasa_lactica :''}}";
    $scope.colinesterasa = "{{($operation == 'update')?$laboratorio->colinesterasa :''}}";
    $scope.acido_lactico = "{{($operation == 'update')?$laboratorio->acido_lactico :''}}";
    $scope.osmolaridad_serica = "{{($operation == 'update')?$laboratorio->osmolaridad_serica :''}}";
    $scope.coproparasitario_rutina = "{{($operation == 'update')?$laboratorio->coproparasitario_rutina :''}}";
    $scope.coproparasitario_seriado = "{{($operation == 'update')?$laboratorio->coproparasitario_seriado :''}}";
    $scope.inv_polimorfonucleares = "{{($operation == 'update')?$laboratorio->inv_polimorfonucleares :''}}";
    $scope.sangre_oculta = "{{($operation == 'update')?$laboratorio->sangre_oculta :''}}";
    $scope.rotavirus = "{{($operation == 'update')?$laboratorio->rotavirus :''}}";
    $scope.ph = "{{($operation == 'update')?$laboratorio->ph :''}}";
    $scope.concentracion = "{{($operation == 'update')?$laboratorio->concentracion :''}}";
    $scope.andenovirus = "{{($operation == 'update')?$laboratorio->andenovirus :''}}";
    $scope.sudan_iii = "{{($operation == 'update')?$laboratorio->sudan_iii :''}}";
    $scope.coprologico = "{{($operation == 'update')?$laboratorio->coprologico :''}}";
    $scope.cea_carcino_embrionario = "{{($operation == 'update')?$laboratorio->cea_carcino_embrionario :''}}";
    $scope.afp_alfa_feto_proteina = "{{($operation == 'update')?$laboratorio->afp_alfa_feto_proteina :''}}";
    $scope.psa_antigeno_prostatico_especifico = "{{($operation == 'update')?$laboratorio->psa_antigeno_prostatico_especifico :''}}";
    $scope.psa_libre = "{{($operation == 'update')?$laboratorio->psa_libre :''}}";
    $scope.ca_125 = "{{($operation == 'update')?$laboratorio->ca_125 :''}}";
    $scope.ca_19_9 = "{{($operation == 'update')?$laboratorio->ca_19_9 :''}}";
    $scope.anti_tpo = "{{($operation == 'update')?$laboratorio->anti_tpo :''}}";
    $scope.neuroenolasa_especifica = "{{($operation == 'update')?$laboratorio->neuroenolasa_especifica :''}}";
    $scope.hcgb = "{{($operation == 'update')?$laboratorio->hcgb :''}}";
    $scope.ca_15_3 = "{{($operation == 'update')?$laboratorio->ca_15_3 :''}}";
    $scope.ca_72_4 = "{{($operation == 'update')?$laboratorio->ca_72_4 :''}}";
    $scope.tiroglobulina = "{{($operation == 'update')?$laboratorio->tiroglobulina :''}}";
    $scope.sodio_e = "{{($operation == 'update')?$laboratorio->sodio_e :''}}";
    $scope.potasio_e = "{{($operation == 'update')?$laboratorio->potasio_e :''}}";
    $scope.cloro_e = "{{($operation == 'update')?$laboratorio->cloro_e :''}}";
    $scope.calcio_total = "{{($operation == 'update')?$laboratorio->calcio_total :''}}";
    $scope.calcio_ionico = "{{($operation == 'update')?$laboratorio->calcio_ionico :''}}";
    $scope.magnesio_e = "{{($operation == 'update')?$laboratorio->magnesio_e :''}}";
    $scope.fosforo_e = "{{($operation == 'update')?$laboratorio->fosforo_e :''}}";
    $scope.cobre = "{{($operation == 'update')?$laboratorio->cobre :''}}";
    $scope.litio = "{{($operation == 'update')?$laboratorio->litio :''}}";
    $scope.amonio = "{{($operation == 'update')?$laboratorio->amonio :''}}";
    $scope.plomo = "{{($operation == 'update')?$laboratorio->plomo :''}}";
    $scope.espermatograma = "{{($operation == 'update')?$laboratorio->espermatograma :''}}";
    $scope.estudio_calculo = "{{($operation == 'update')?$laboratorio->estudio_calculo :''}}";
    $scope.citoquimico_lcr = "{{($operation == 'update')?$laboratorio->citoquimico_lcr :''}}";
    $scope.pap_test = "{{($operation == 'update')?$laboratorio->pap_test :''}}";
    $scope.cultivo_antibiograma = "{{($operation == 'update')?$laboratorio->cultivo_antibiograma :''}}";
    $scope.gram = "{{($operation == 'update')?$laboratorio->gram :''}}";
    $scope.fresco = "{{($operation == 'update')?$laboratorio->fresco :''}}";
    $scope.baar = "{{($operation == 'update')?$laboratorio->baar :''}}";
    $scope.investigacion_hongos_koh = "{{($operation == 'update')?$laboratorio->investigacion_hongos_koh :''}}";
    $scope.control_tratamiento = "{{($operation == 'update')?$laboratorio->control_tratamiento :''}}";
    $scope.bh = "{{($operation == 'update')?$laboratorio->bh :''}}";
    $scope.hdl = "{{($operation == 'update')?$laboratorio->hdl :''}}";
    $scope.urea = "{{($operation == 'update')?$laboratorio->urea :''}}";
    $scope.ldl = "{{($operation == 'update')?$laboratorio->ldl :''}}";
    $scope.glucosa = "{{($operation == 'update')?$laboratorio->glucosa :''}}";
    $scope.creatinina = "{{($operation == 'update')?$laboratorio->creatinina :''}}";
    $scope.tsh = "{{($operation == 'update')?$laboratorio->tsh :''}}";
    $scope.trigliceridos = "{{($operation == 'update')?$laboratorio->trigliceridos :''}}";
    $scope.tsh_t3_ft3 = "{{($operation == 'update')?$laboratorio->tsh_t3_ft3 :''}}";
    $scope.t4_ft4 = "{{($operation == 'update')?$laboratorio->t4_ft4 :''}}";
    $scope.lh = "{{($operation == 'update')?$laboratorio->lh :''}}";
    $scope.fsh = "{{($operation == 'update')?$laboratorio->fsh :''}}";
    $scope.prl = "{{($operation == 'update')?$laboratorio->prl :''}}";
    $scope.e2 = "{{($operation == 'update')?$laboratorio->e2 :''}}";
    $scope.p4 = "{{($operation == 'update')?$laboratorio->p4 :''}}";
    $scope.igf1 = "{{($operation == 'update')?$laboratorio->igf1 :''}}";
    $scope.igbp3 = "{{($operation == 'update')?$laboratorio->igbp3 :''}}";
    $scope.pth = "{{($operation == 'update')?$laboratorio->pth :''}}";
    $scope.estriol = "{{($operation == 'update')?$laboratorio->estriol :''}}";
    $scope.androstendiona = "{{($operation == 'update')?$laboratorio->androstendiona :''}}";
    $scope.cortisol_am = "{{($operation == 'update')?$laboratorio->cortisol_am :''}}";
    $scope.cortisol_pm = "{{($operation == 'update')?$laboratorio->cortisol_pm :''}}";
    $scope.acth = "{{($operation == 'update')?$laboratorio->acth :''}}";
    $scope.testosterona_total = "{{($operation == 'update')?$laboratorio->testosterona_total :''}}";
    $scope.testosterona_libre = "{{($operation == 'update')?$laboratorio->testosterona_libre :''}}";
    $scope.hcg_cuantitativa = "{{($operation == 'update')?$laboratorio->hcg_cuantitativa :''}}";
    $scope.hormona_crecimiento_peptido_c = "{{($operation == 'update')?$laboratorio->hormona_crecimiento_peptido_c :''}}";
    $scope.ferritina = "{{($operation == 'update')?$laboratorio->ferritina :''}}";
    $scope.insulina_ayudas = "{{($operation == 'update')?$laboratorio->insulina_ayudas :''}}";
    $scope.insulina_2_h = "{{($operation == 'update')?$laboratorio->insulina_2_h :''}}";
    $scope.peptido_c = "{{($operation == 'update')?$laboratorio->peptido_c :''}}";
    $scope.perfil_general = "{{($operation == 'update')?$laboratorio->perfil_general :''}}";
    $scope.cocaina = "{{($operation == 'update')?$laboratorio->cocaina :''}}";
    $scope.marihuana = "{{($operation == 'update')?$laboratorio->marihuana :''}}";
    $scope.ac_valproico = "{{($operation == 'update')?$laboratorio->ac_valproico :''}}";
    $scope.carbamazepina = "{{($operation == 'update')?$laboratorio->carbamazepina :''}}";
    $scope.ciclosporina_basal = "{{($operation == 'update')?$laboratorio->ciclosporina_basal :''}}";
    $scope.ciclosporina_2horas = "{{($operation == 'update')?$laboratorio->ciclosporina_2horas :''}}";
    $scope.digoxina = "{{($operation == 'update')?$laboratorio->digoxina :''}}";
    $scope.escopolamina = "{{($operation == 'update')?$laboratorio->escopolamina :''}}";
    $scope.fenitoina = "{{($operation == 'update')?$laboratorio->fenitoina :''}}";
    $scope.fenobarbital = "{{($operation == 'update')?$laboratorio->fenobarbital :''}}";
    $scope.teofilina = "{{($operation == 'update')?$laboratorio->teofilina :''}}";
    $scope.vancomicina = "{{($operation == 'update')?$laboratorio->vancomicina :''}}";
    $scope.perfil_diabetes = "{{($operation == 'update')?$laboratorio->perfil_diabetes :''}}";
    $scope.pefil_hepatico = "{{($operation == 'update')?$laboratorio->pefil_hepatico :''}}";
    $scope.perfil_lipidico = "{{($operation == 'update')?$laboratorio->perfil_lipidico :''}}";
    $scope.perfil_reumatico = "{{($operation == 'update')?$laboratorio->perfil_reumatico :''}}";
    $scope.tiroiditis = "{{($operation == 'update')?$laboratorio->tiroiditis :''}}";
    $scope.prequirurgico = "{{($operation == 'update')?$laboratorio->prequirurgico :''}}";
    $scope.pruebas_inmunologicas = "{{($operation == 'update')?$laboratorio->pruebas_inmunologicas :''}}";
    $scope.hipotiroidismo = "{{($operation == 'update')?$laboratorio->hipotiroidismo :''}}";
    $scope.copia_cefalica = "{{($operation == 'update')?$laboratorio->copia_cefalica :''}}";
    $scope.copia_cefalometria = "{{($operation == 'update')?$laboratorio->copia_cefalometria :''}}";
    $scope.panoramico_digital_shick = "{{($operation == 'update')?$laboratorio->panoramico_digital_shick :''}}";
    $scope.cdrpank_schick_panoramico_digital = "{{($operation == 'update')?$laboratorio->cdrpank_schick_panoramico_digital :''}}";
    $scope.schick_panoramico_digital = "{{($operation == 'update')?$laboratorio->schick_panoramico_digital :''}}";
    $scope.tomografia_dental_3d = "{{($operation == 'update')?$laboratorio->tomografia_dental_3d :''}}";
    $scope.tomografia_senos_nasales = "{{($operation == 'update')?$laboratorio->tomografia_senos_nasales :''}}";
    $scope.tomografia_atm = "{{($operation == 'update')?$laboratorio->tomografia_atm :''}}";
    $scope.oclusal_superior = "{{($operation == 'update')?$laboratorio->oclusal_superior :''}}";
    $scope.oclusal_inferior = "{{($operation == 'update')?$laboratorio->oclusal_inferior :''}}";
    $scope.rx_panoramica = "{{($operation == 'update')?$laboratorio->rx_panoramica :''}}";
    $scope.rx_cefalica_perfil = "{{($operation == 'update')?$laboratorio->rx_cefalica_perfil :''}}";
    $scope.cefalometria = "{{($operation == 'update')?$laboratorio->cefalometria :''}}";
    $scope.modelos_ortodoncia = "{{($operation == 'update')?$laboratorio->modelos_ortodoncia :''}}";
    $scope.fotografia_ortodoncia = "{{($operation == 'update')?$laboratorio->fotografia_ortodoncia :''}}";
    $scope.estudio_ortodoncia = "{{($operation == 'update')?$laboratorio->estudio_ortodoncia :''}}";
    $scope.copia_tomografia = "{{($operation == 'update')?$laboratorio->copia_tomografia :''}}";
    $scope.informe_examen = "{{($operation == 'update')?$laboratorio->informe_examen :''}}";
    $scope.planificacion_implantes = "{{($operation == 'update')?$laboratorio->planificacion_implantes :''}}";
    $scope.copia_rx_panoramico = "{{($operation == 'update')?$laboratorio->copia_rx_panoramico :''}}";
    $scope.rx_anteroposterior_cara = "{{($operation == 'update')?$laboratorio->rx_anteroposterior_cara :''}}";
    $scope.rx_posteroanterior_cara = "{{($operation == 'update')?$laboratorio->rx_posteroanterior_cara :''}}";
    $scope.rx_articulacion_tmp_mandibular_ba = "{{($operation == 'update')?$laboratorio->rx_articulacion_tmp_mandibular_ba :''}}";
    $scope.rx_articulacion_tmp_mandibular_bc = "{{($operation == 'update')?$laboratorio->rx_articulacion_tmp_mandibular_bc :''}}";
    $scope.informe_radiologico_simple = "{{($operation == 'update')?$laboratorio->informe_radiologico_simple :''}}";
    $scope.informe_radiologico_completo = "{{($operation == 'update')?$laboratorio->informe_radiologico_completo :''}}";
    $scope.servicios_varios = "{{($operation == 'update')?$laboratorio->servicios_varios :''}}";
    $scope.trazado_cefalometrico_sin_placa = "{{($operation == 'update')?$laboratorio->trazado_cefalometrico_sin_placa :''}}";
    $scope.txt_otros_orina = "{{($operation == 'update')?$laboratorio->txt_otros_orina :''}}";
    $scope.txtOtrosElectro = "{{($operation == 'update')?$laboratorio->txtOtrosElectro :''}}";
    $scope.txtEstLiq = "{{($operation == 'update')?$laboratorio->txtEstLiq :''}}";
    $scope.txtMuestra = "{{($operation == 'update')?$laboratorio->txtMuestra :''}}";
    $scope.txtDiasNo = "{{($operation == 'update')?$laboratorio->txtDiasNo :''}}";
  };

 //Ejecuto la funcion anterior init()

  $scope.init();

  //Implementacion de método para crear un JSON a partir de la serializacion del FORM

  $scope.serializeObject = function (obj)
  {
    var o = {};
    var a = obj.serializeArray();
    $.each(a, function ()
    {
      if (o[this.name] !== undefined) {
        if (!o[this.name].push) {
          o[this.name] = [o[this.name]];
        }
        o[this.name].push(this.value || '');
      } else {
        o[this.name] = this.value || '';
      }
    });

    o=JSON.stringify(o);
    o= o.replace(/\\r\\n/g, "\\\\n");
    o=JSON.parse(o);

    return o;
  };

  //Implementacion de método que crea un switsh que tiene 2 casos,
  // uno para AÑADIR y otro para ACTUALIZAR.
  // El parametro (operation) puede tomar valores de
  //add o update

  $scope.toggle = function (operation)
  {
    switch (operation) {
      case 'add':

        $(".modal").modal('show');
        console.log($scope.serializeObject($("#form_laboratorio")));
        $http({
          url    : API_URL + 'laboratorio/custom_laboratorio',
          method : 'POST',
          params : $scope.serializeObject($("#form_laboratorio")),
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).then(function (response)
        {
          $(".modal").modal('hide');
          if (response.data.response) {
            swal({
              title: "Buen trabajo!",
              text: "Se ha guardado exitosamente!",
              type: "success",
              showCancelButton: false,
              confirmButtonClass: "btn-succes",
              confirmButtonText: "OK",
              closeOnConfirm: true
            },
            function(){
              $(".modal").modal('show');
              window.location = "{{ url('/admin/laboratorio?m=26') }}";
            });
          } else {
            swal("Error", "¡No se guardó!", "error");
          }
        });

        break;

      case 'update':

        $(".modal").modal('show');

        $http({
          url    : API_URL + 'laboratorio/custom_laboratorio/{{$laboratorio->id}}',
          method : 'PUT',
          params : $scope.serializeObject($("#form_laboratorio")),
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).then(function (response)
        {
          $(".modal").modal('hide');
          if (response.data.response) {
            swal({
              title: "Buen trabajo!",
              text: "Actualización exitosa!",
              type: "success",
              showCancelButton: false,
              confirmButtonClass: "btn-succes",
              confirmButtonText: "OK",
              closeOnConfirm: true
            },
            function(){
              $(".modal").modal('show');
              window.location = "{{ url('/admin/laboratorio?m=26') }}";
            });
            } else {
              swal("Error", "No se actualizó", "error");
            }
          });
          break;
    }
  }
});
