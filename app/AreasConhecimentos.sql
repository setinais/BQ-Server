/*1.00.00.00 3		CIÊNCIAS EXATAS E DA TERRA
 1.01.99.00 4	Matemática  
 1.02.99.00 9	Probabilidade e Estatística
 1.03.99.00 3	Ciência da Computação
 1.04.99.00 8	Astronomia           
 1.05.99.00 2	Física
 1.06.99.00 7	Química
 1.07.99.00 1	Geociências
 1.08.99.00 6	Oceanografia

2.00.00.00 6		CIÊNCIAS BIOLÓGICAS
 2.01.99.00 7	Biologia Geral
 2.02.99.00 1	Genética
 2.03.99.00 6	Botânica
 2.04.99.00 0	Zoologia
 2.05.99.00 5	Ecologia
 2.06.99.00 0	Morfologia
 2.07.99.00 4	Fisiologia
 2.08.99.00 9	Bioquímica
 2.09.99.00 3	Biofísica
 2.10.99.00 6	Farmacologia
 2.11.99.00 0	Imunologia
 2.12.99.00 5	Microbiologia
 2.13.99.00 0	Parasitologia

3.00.00.00 9		ENGENHARIAS
 3.01.99.00 0	Engenharia Civil
 3.02.99.00 4	Engenharia de Minas
 3.03.99.00 9	Engenharia de Materiais e Metalúrgica
 3.04.99.00 3	Engenharia Elétrica
 3.05.99.00 8	Engenharia Mecânica
 3.06.99.00 2	Engenharia Química
 3.07.99.00 7	Engenharia Sanitária
 3.08.99.00 1	Engenharia de Produção 
 3.09.99.00 6	Engenharia Nuclear
 3.10.99.00 9	Engenharia de Transportes
 3.11.99.00 3	Engenharia Naval e Oceânica
 3.12.99.00 8	Engenharia Aeroespacial
 3.13.99.00 2	Engenharia Biomédica
   

4.00.00.00 1		CIÊNCIAS DA SAÚDE

 4.01.99.00 2	Medicina
 4.02.99.00 7	Odontologia
 4.03.99.00 1	Farmácia
 4.04.99.00 6	Enfermagem
 4.05.99.00 0	Nutrição
 4.06.99.00 5	Saúde Coletiva
 4.07.99.00 0	Fonoaudiologia
 4.08.99.00 4	Fisioterapia e Terapia Ocupacional
 4.09.99.00 9	Educação Física

5.00.00.00 4		CIÊNCIAS AGRÁRIAS
 5.01.99.00 5	Agronomia
 5.02.99.00-0	Recursos Florestais e Engenharia Florestal 
 5.03.99.00 4	Engenharia Agrícola
 5.04.99.00 9	Zootecnia
 5.05.99.00 3	Medicina Veterinária
 5.06.99.00 8	Recursos Pesqueiros e Engenharia de Pesca
 5.07.99.00 2	Ciência e Tecnologia de Alimentos

6.00.00.00 7		CIÊNCIAS SOCIAIS APLICADAS

 6.01.99.00 8	Direito 
 6.02.99.00 2	Administração
 6.03.99.00 7	Economia
 6.04.99.00 1	Arquitetura e Urbanismo
 6.05.99.00 6	Planejamento Urbano e Regional
 6.06.99.00 0	Demografia
 6.06.07.00 9	Fontes de Dados Demográficos
 6.07.99.00 5	Ciência da Informação
 6.08.99.00 0	Museologia
 6.09.99.00 4	Comunicação
 6.10.99.00 7	Serviço Social
 6.11.99.00 1	Economia Doméstica
 6.12.99.00 6	Desenho Industrial
 6.13.99.00 0	Turismo

7.00.00.00 0		CIÊNCIAS HUMANAS

 7.01.99.00 0	Filosofia
 7.02.99.00 5	Sociologia
 7.02.03.00 8	Sociologia do Desenvolvimento
 7.03.99.00 0	Antropologia
 7.04.99.00 4	Arqueologia
 7.05.99.00 9	História
 7.06.99.00 3	Geografia
 7.07.99.00 8	Psicologia
 7.08.99.00 2	Educação
 7.09.99.00 7	Ciência Política
 7.10.99.00 0	Teologia
 7.10.01.00 0	História da Teologia
   
8.00.00.00 2		LINGÜÍSTICA, LETRAS E ARTES 

 8.01.99.00 3	Lingüística
 8.02.99.00 8	Letras
 8.03.99.00 2	Artes*/
 
 INSERT INTO `area_conhecimentos`(`area_de_conhecimento`, `sub_categoria_id`, `created_at`) VALUES 
("CIÊNCIAS EXATAS E DA TERRA", NULL, NOW()),
("CIÊNCIAS BIOLÓGICAS", NULL, NOW()),
("ENGENHARIAS", NULL, NOW()),
("CIÊNCIAS DA SAÚDE", NULL, NOW()),
("CIÊNCIAS AGRÁRIAS", NULL, NOW()),
("CIÊNCIAS SOCIAIS APLICADAS", NULL, NOW()),
(" CIÊNCIAS HUMANAS", NULL, NOW()),
("LINGÜÍSTICA, LETRAS E ARTES ", NULL, NOW());

INSERT INTO `area_conhecimentos`(`area_de_conhecimento`, `sub_categoria_id`, `created_at`) VALUES 
("Matemática",                   1, now()),  
("Probabilidade e Estatística",  1, now()),
("Ciência da Computação",        1, now()),
("Astronomia",                   1, now()),      
("Física",                       1, now()),
("Química",                      1, now()),
("Geociências",                  1, now()),
("Oceanografia",                 1, now()),

(" Biologia Geral",  2, now()), 
("Genética",         2, now()),
("Botânica",         2, now()),
("Zoologia",         2, now()),
("Ecologia",         2, now()),
("Morfologia" ,      2, now()),
("Fisiologia" ,      2, now()),
("Bioquímica" ,      2, now()),
("Biofísica"  ,      2, now()),
("Farmacologia",     2, now()),
("Imunologia",       2, now()),
("Microbiologia" ,   2, now()),
("Parasitologia" ,   2, now()),

 (" Engenharia Civil" ,                      3 , now()),
 ("Engenharia de Minas" ,                    3 , now()),
 ("Engenharia de Materiais e Metalúrgica" ,  3 , now()),
 ("Engenharia Elétrica" ,                    3 , now()),
 ("Engenharia Mecânica" ,                    3 , now()),
 ("Engenharia Química" ,                     3 , now()),
 ("Engenharia Sanitária" ,                   3 , now()),
 ("Engenharia de Produção " ,                3 , now()),
 ("Engenharia Nuclear" ,                     3 , now()),
 ("Engenharia de Transportes" ,              3 , now()),
 ("Engenharia Naval e Oceânica" ,            3 , now()),
 ("Engenharia Aeroespacial" ,                3 , now()),
 ("Engenharia Biomédica" ,                   3 , now()),
   
 (" Medicina", 4, now()),
 ("Odontologia", 4, now()),
 ("Farmácia", 4, now()),
 ("Enfermagem", 4, now()),
 ("Nutrição", 4, now()),
 ("Saúde Coletiva", 4, now()),
 ("Fonoaudiologia", 4, now()),
 ("Fisioterapia e Terapia Ocupacional", 4, now()),
 ("Educação Física", 4, now()),

 ("Agronomia", 5, now()),
 ("Recursos Florestais e Engenharia Florestal ", 5, now()),
 ("Engenharia Agrícola", 5, now()),
 ("Zootecnia", 5, now()),
 ("Medicina Veterinária", 5, now()),
 ("Recursos Pesqueiros e Engenharia de Pesca", 5, now()),
 ("Ciência e Tecnologia de Alimentos", 5, now()),

 ("Direito ", 6, now()),
 ("Administração", 6, now()),
 ("Economia", 6, now()),
 ("Arquitetura e Urbanismo", 6, now()),
 ("Planejamento Urbano e Regional", 6, now()),
 ("Demografia", 6, now()),
 ("Fontes de Dados Demográficos", 6, now()),
 ("Ciência da Informação", 6, now()),
 ("Museologia", 6, now()),
 ("Comunicação", 6, now()),
 ("Serviço Social", 6, now()),
 ("Economia Doméstica", 6, now()),
 ("Desenho Industrial", 6, now()),
 ("Turismo", 6, now()),

 ("Filosofia", 7, now()),
 ("Sociologia", 7, now()),
 ("Sociologia do Desenvolvimento", 7, now()),
 ("Antropologia", 7, now()),
 ("Arqueologia", 7, now()),
 ("História", 7, now()),
 ("Geografia", 7, now()),
 ("Psicologia", 7, now()),
 ("Educação", 7, now()),
 ("Ciência Política", 7, now()),
 ("Teologia", 7, now()),
 ("História da Teologia", 7, now()),

 ("Lingüística", 8, now()),
 ("Letras", 8, now()),
 ("Artes", 8, now());