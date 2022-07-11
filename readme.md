1. clone repo
2. go to project dir
3. run *docker-compose build*
4. run *docker-compose up -d*
5. *docker exec -it -u dev sf4_php bash*
6. run command to generate all possible combinations:
   - **php bin/console app:generate-files-combinations zad1-base.json zad1-params-config.json**

input files are in ./input_files
output files are generate to ./output_files