//V3.0
QCRM.users_dropdown=true;
QCRM.share_search='All';
QCRM.native_cal=true;
QCRM.AOS_show_image=true;
QCRM.forceLock=false;
QCRM.enableBeans(['Accounts','Contacts','Tasks','Calls','Meetings','Opportunities','Notes','Documents','Project','ProjectTask','Cases','mkt_Worklogs','Emails','AOS_Products','AOS_Quotes','AOR_Reports','AOS_Product_Categories']);
Beans['Accounts'].AdditionalFields = ['phone_office','phone_fax','website','email1','description','vat_number_c','codice_fiscale_c','$ADDbilling','$ADDshipping','imp_agent_code_c','industry','imp_status_c','imp_status_phase__c','imp_forced_status_c','ft_periodo_attuale_c','mesimobili12_c','dagenaoggi_c','ft_anno_meno_uno_completo_c','imp_profitability_c','credit_risk_c','imp_client_yearly_revenue_c','imp_interest_articles_c','employee_number_c','imp_competitor_c','imp_other_competitor_c','imp_ex_agent_code_c','imp_sync_as_client_c','imp_sync_as_supplier_c','imp_macchine_c','imp_macchine_proprieta_c','imp_macchine_note_c','imp_metodo_notes_c'];
Beans['Accounts'].SearchFields = ['imp_agent_code_c','imp_ex_agent_code_c','vat_number_c','industry','imp_status_c','imp_status_phase__c','imp_forced_status_c','ft_periodo_attuale_c','mesimobili12_c','dagenaoggi_c','ft_anno_meno_uno_completo_c','zone_c','billing_address_street'];
Beans['Accounts'].CustomListFields = ['billing_address_city','industry','imp_status_phase__c','mesimobili12_c'];
Beans['Accounts'].CustomLinks = {'opportunities':{title:'Opportunities'},'calls':{title:'Calls'},'meetings':{title:'Meetings'},'tasks':{title:'Tasks'},'cases':{title:'Cases'},'project':{title:'Project'},'notes':{title:'Notes'},'documents':{title:'Documents'},'accounts_contacts_imp_dir':{title:'LBL_ACCOUNTS_CONTACTS_IMP_DIR_CONTACTS'},'accounts_contacts_imp_acq':{title:'LBL_ACCOUNTS_CONTACTS_IMP_ACQ_CONTACTS'},'accounts_contacts_imp_adm':{title:'LBL_ACCOUNTS_CONTACTS_IMP_ADM_CONTACTS'},'accounts_contacts_imp_com':{title:'LBL_ACCOUNTS_CONTACTS_IMP_COM_CONTACTS'},'accounts_contacts_imp_opr':{title:'LBL_ACCOUNTS_CONTACTS_IMP_OPR_CONTACTS'},'accounts_contacts_mekit_dir':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_DIR_CONTACTS'},'accounts_contacts_mekit_acq':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_ACQ_CONTACTS'},'accounts_contacts_mekit_adm':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_ADM_CONTACTS'},'accounts_contacts_mekit_com':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_COM_CONTACTS'},'accounts_contacts_mekit_opr':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_OPR_CONTACTS'},'aos_quotes':{title:'AOS_Quotes'}};
Beans['Accounts'].ColoredField = 'imp_status_phase__c';
Beans['Contacts'].AdditionalFields = ['title','email1','phone_work','phone_mobile','description','$ADDprimary','$ADDalt','gender_c','birthdate','family_members_c','marital_status_c','metodo_sync_up_c'];
Beans['Contacts'].SearchFields = ['email1'];
Beans['Contacts'].CustomListFields = ['account_name','title'];
Beans['Contacts'].TitleFields = ['first_name','last_name'];
Beans['Contacts'].CustomLinks = {'calls':{title:'Calls'},'meetings':{title:'Meetings'},'tasks':{title:'Tasks'},'opportunities':{title:'Opportunities'},'documents':{title:'Documents'},'notes':{title:'LBL_NOTES'},'cases':{title:'Cases'},'project':{title:'LBL_PROJECTS'},'accounts_contacts_imp_dir':{title:'LBL_ACCOUNTS_CONTACTS_IMP_DIR_ACCOUNTS'},'accounts_contacts_imp_adm':{title:'LBL_ACCOUNTS_CONTACTS_IMP_ADM_ACCOUNTS'},'accounts_contacts_imp_acq':{title:'LBL_ACCOUNTS_CONTACTS_IMP_ACQ_ACCOUNTS'},'accounts_contacts_imp_com':{title:'LBL_ACCOUNTS_CONTACTS_IMP_COM_ACCOUNTS'},'accounts_contacts_mekit_opr':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_OPR_ACCOUNTS'},'accounts_contacts_imp_opr':{title:'LBL_ACCOUNTS_CONTACTS_IMP_OPR_ACCOUNTS'},'accounts_contacts_mekit_dir':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_DIR_ACCOUNTS'},'accounts_contacts_mekit_adm':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_ADM_ACCOUNTS'},'accounts_contacts_mekit_acq':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_ACQ_ACCOUNTS'},'accounts_contacts_mekit_com':{title:'LBL_ACCOUNTS_CONTACTS_MEKIT_COM_ACCOUNTS'}};
Beans['Tasks'].AdditionalFields = ['status','date_start','date_due','priority','description','contact_name','parent_name','assigned_user_name'];
Beans['Tasks'].SearchFields = ['status','date_due','priority'];
Beans['Tasks'].CustomListFields = ['status','date_start','date_due','priority'];
Beans['Tasks'].CustomLinks = {'notes':{title:'Notes'},'mkt_worklogs_tasks':{title:'mkt_Worklogs'}};
Beans['Calls'].AdditionalFields = ['direction','status','result_c','date_schedule_c','date_start','duration_hours','duration_minutes','description','parent_name','assigned_user_name'];
Beans['Calls'].SearchFields = ['status','date_schedule_c','date_start'];
Beans['Calls'].CustomListFields = ['status','parent_name','date_schedule_c','date_start'];
Beans['Calls'].CustomLinks = {'contacts':{title:'Contacts'},'users':{title:'Users'},'notes':{title:'Notes'}};
Beans['Meetings'].AdditionalFields = ['status','motivazione_non_effettuata_c','type','date_start','duration_hours','duration_minutes','description','parent_name','fogliolavoro_c','meeting_type_c','join_url','creator','assigned_user_name'];
Beans['Meetings'].SearchFields = ['status','date_start','assigned_user_name'];
Beans['Meetings'].CustomListFields = ['status','date_start'];
Beans['Meetings'].CustomLinks = {'contacts':{title:'Contacts'},'users':{title:'Users'},'notes':{title:'Notes'},'mkt_worklogs_meetings':{title:'mkt_Worklogs'}};
Beans['Opportunities'].AdditionalFields = ['identificativo_c','amount','date_closed','account_name','description','assigned_user_name','statovendita_c','fase_stato_vendita_c','promemoria_ricontattare_il_c'];
Beans['Opportunities'].SearchFields = ['identificativo_c','date_closed','assigned_user_name','statovendita_c','fase_stato_vendita_c','account_name'];
Beans['Opportunities'].CustomListFields = ['account_name','statovendita_c','date_closed'];
Beans['Opportunities'].CustomLinks = {'aos_quotes':{title:'AOS_Quotes'},'contacts':{title:'Contacts'},'calls':{title:'Calls'},'meetings':{title:'Meetings'},'tasks':{title:'Tasks'},'notes':{title:'Notes'},'documents':{title:'Documents'},'emails':{title:'Emails'},'project':{title:'Project'},'mkt_worklogs_opportunities':{title:'mkt_Worklogs'}};
Beans['Opportunities'].ColoredField = 'statovendita_c';
Beans['Notes'].AdditionalFields = ['description','filename','image_c','assigned_user_name'];
Beans['Notes'].CustomListFields = ['filename'];
Beans['Notes'].CustomLinks = [];
Beans['Documents'].AdditionalFields = ['description','status_id','category_id','assigned_user_name'];
Beans['Documents'].SearchFields = ['status_id','category_id'];
Beans['Documents'].TitleFields = ['document_name'];
Beans['Documents'].CustomLinks = {'accounts':{title:'Accounts'},'contacts':{title:'Contacts'},'opportunities':{title:'Opportunities'},'cases':{title:'Cases'}};
Beans['Project'].AdditionalFields = ['status','priority','tipo_c','assigned_user_name','estimated_start_date','estimated_end_date','area_dinteresse_imp_c','analisi_realta_c','aggiornamenti_c','conclusioni_c','fineeffettiva_c','description'];
Beans['Project'].SearchFields = ['status','assigned_user_name','priority','area_dinteresse_imp_c','area_dinteresse_mekit_c'];
Beans['Project'].CustomLinks = {'projecttask':{title:'ProjectTask'},'tasks':{title:'Tasks'},'mkt_worklogs_project':{title:'mkt_Worklogs'},'contacts':{title:'LBL_CONTACTS'},'project_contacts_1':{title:'LBL_PROJECT_CONTACTS_1_FROM_CONTACTS_TITLE'},'notes':{title:'Notes'},'opportunities':{title:'Opportunities'},'accounts':{title:'Accounts'},'meetings':{title:'Meetings'},'calls':{title:'Calls'},'emails':{title:'Emails'},'cases':{title:'Cases'},'project_users_1':{title:'Users'}};
Beans['ProjectTask'].AdditionalFields = ['task_number','order_number','status','priority','project_name','date_start','date_finish','description','milestone_flag','relationship_type','predecessors','assigned_user_name'];
Beans['ProjectTask'].SearchFields = ['date_start','date_finish','status','priority','project_name'];
Beans['ProjectTask'].CustomListFields = ['status','priority','assigned_user_name','project_name'];
Beans['ProjectTask'].CustomLinks = {'notes':{title:'Notes'},'tasks':{title:'Tasks'},'meetings':{title:'Meetings'},'calls':{title:'Calls'},'emails':{title:'Emails'}};
Beans['ProjectTask'].ColoredField = 'priority';
Beans['Cases'].AdditionalFields = ['case_number','status','priority','description','account_name'];
Beans['Cases'].SearchFields = ['type','date_close_prg_c','state','status','priority','descrizione_problematica_c','account_name','area_dinteresse_imp_c','date_close_efct_c','origine_c','ref_worksheet_c','resolution','assigned_user_name'];
Beans['Cases'].CustomListFields = ['status','priority'];
Beans['Cases'].CustomLinks = {'tasks':{title:'Tasks'},'meetings':{title:'Meetings'},'calls':{title:'Calls'},'contacts':{title:'Contacts'}};
Beans['mkt_Worklogs'].SearchFields = ['operation_type','description','duration_hrs','parent_name','duration_min','assigned_user_name'];
Beans['mkt_Worklogs'].CustomLinks = [];
Beans['Emails'].AdditionalFields = ['description','description_html','type'];
Beans['Emails'].CustomLinks = [];
Beans['AOS_Products'].AdditionalFields = ['part_number','description','cost','price_lst_9997_c','price','price_lst_10000_c','stock_c','sold_last_120_days_c','aos_product_category_name','product_image'];
Beans['AOS_Products'].SearchFields = ['part_number','aos_product_category_name'];
Beans['AOS_Products'].CustomListFields = ['part_number','aos_product_category_name'];
Beans['AOS_Products'].CustomLinks = [];
Beans['AOS_Quotes'].AdditionalFields = ['document_number_c','document_year_c','data_doc_c','description','billing_account','expiration','subtotal_amount','discount_amount','discount_percent_c','opportunity','imp_agent_code_c','dsc_payment_c'];
Beans['AOS_Quotes'].SearchFields = ['document_year_c','document_number_c','data_doc_c','opportunity','billing_account','imp_agent_code_c','assigned_user_name'];
Beans['AOS_Quotes'].CustomListFields = ['document_year_c','billing_account','opportunity','subtotal_amount'];
Beans['AOS_Quotes'].CustomLinks = [];
Beans['AOS_Quotes'].ColoredField = 'approval_status';
Beans['AOR_Reports'].AdditionalFields = ['date_entered','modified_by_name','graphs_per_row','description','report_module','assigned_user_name'];
Beans['AOR_Reports'].SearchFields = ['date_entered','date_modified','report_module','graphs_per_row','assigned_user_name'];
Beans['AOR_Reports'].CustomListFields = ['report_module'];
Beans['AOR_Reports'].CustomLinks = [];
Beans['AOS_Product_Categories'].AdditionalFields = ['description','is_parent','parent_category_name','metodo_category_code_c'];
Beans['AOS_Product_Categories'].SearchFields = ['description','metodo_category_code_c','is_parent','parent_category_name'];
Beans['AOS_Product_Categories'].CustomListFields = ['description','parent_category_name'];
Beans['AOS_Product_Categories'].CustomLinks = {'sub_categories':{title:'LBL_SUB_CATEGORIES'},'aos_products':{title:'AOS_Products'}};
Beans['AOS_Product_Categories'].ColoredField = 'is_parent';
QCRM.Profiles={};QCRM.ProfileMode='SecurityGroups';
RowsPerPage=20;
SimpleBeans['Users'].query += 'AND (users.is_group=0 OR users.is_group IS NULL)';
QCRM.addressFields=['street','city','state','postalcode','country'];
QCRM.google_addressFields=['street','city','state','postalcode','country'];
