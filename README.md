## Par Projektu

Lietišķo datorsistēmu programmatūras kursa projekts. AESolution grupa. 
Autori: Artjoms Tatagaškins, Ēriks Golovļovs.

## Projekta struktūra

/app/http/controllers satur PipelineController.php, kas ir atbildīgs par datu iegūšanu no GitLab, izmantojot tokenu. Šajā failā jānorāda ceļš līdz GitLab projektam un tokenu, ko var iegūt GitLab projekta iestatījumos.
/routes satur projekta maršrutus.
/resources satur projekta stilus app.scss failā (projekts izmanto SCSS, ko Vite automatiski pārveido CSS, izmantojot vite.config.js), JS skriptus app.js failā.
/resources/views satur blade šablonus pamata projekta lapām.

PHP: 8.2
Laravel/framework: 12.0
Tailwindcss: 4.1.6
Vite: 6.35.0
SASS: 1.87.0

## Projekta palaišana

Jāinstalē Laravel.
Jāinstalē visas attiecīgās atkarības.
Jānorādā datubāzes piekļuves datus failā .env (projekts izmanto MySQL).
Kad projekts ir uzbūvēts un darbojas, lapa būs pieejama standarta adresē http://127.0.0.1:8000/pipelines.

## Paveiktais

Šobrīd ir gatavs galvenās lapas vizuālais attēlojums ar cauruļvadu sarakstu.
