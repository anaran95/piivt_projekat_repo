<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* _global/index.html */
class __TwigTemplate_af2e63db95bff0acc1c2543451f134ee132817fbf0974ee21bb128df0c487aea extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'naslov' => [$this, 'block_naslov'],
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!doctype html><!--fajl koji sluzi kao osnovni sablon za integraciju view-ova (delova html koda) i koji ce svi view-ovi da naslede-->
<html>
    <head>
        <title>K&amp;A - ";
        // line 4
        $this->displayBlock('naslov', $context, $blocks);
        echo "</title>
        <meta charset=\"utf-8\">
        <!--<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/css/main.css\">-->
        <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/css/bootstrap.min.css\">
        <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/font-awesome/css/font-awesome.min.css\">
        <link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/css/style.css\">
    </head>
    <body>
        <div class=\"container\">
            <header>
                <div class=\"row\">
                    <div class=\"col col-sm\"> <!--Moze da ima vise bannera koji se slide-uju naizmenicno u krug-->
                        <a href=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "\">
                            <img class=\"site-banner\" src=\"";
        // line 17
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/site_banner.png\" alt=\"Banner 1\"><!--Za sada ovaj folder ne postoji-->
                        </a>
                    </div>
                    <div class=\"col col-sm\">
                        <div class=\"social-icons text-right\">
                            <a href=\"#\"><img src=\"";
        // line 22
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/social/linkedin.png\" alt=\"Li\"></a>
                            <a href=\"#\"><img src=\"";
        // line 23
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/social/facebook.png\" alt=\"Fb\"></a>
                            <a href=\"#\"><img src=\"";
        // line 24
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/social/twitter.png\" alt=\"Tw\"></a>
                            <a href=\"#\"><img src=\"";
        // line 25
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/social/google-plus.png\" alt=\"Gp\"></a>
                            <a href=\"#\"><img src=\"";
        // line 26
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/social/youtube.png\" alt=\"Yt\"></a>
                        </div>
                        <div class=\"search-box\">
                            <form method=\"post\" action=\"";
        // line 29
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "search\">
                                <div class=\"form-group\">
                                    <div class=\"input-group\">
                                        <input type=\"text\" name=\"q\" class=\"form-control\"
                                               placeholder=\"Ključne reči pretrage\">
                                        <button type=\"submit\" 
                                                class=\"btn btn-primary input-group-append\">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <nav class=\"navbar navbar-expand-lg navbar-dark bg-primary\">
                    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNavAltMarkup\" aria-controls=\"navbarNavAltMarkup\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                        <span class=\"navbar-toggler-icon\"></span>
                    </button>
                    <div class=\"collapse navbar-collapse\" id=\"navbarNavAltMarkup\">
                        <div class=\"navbar-nav\">
                            <a class=\"nav-item nav-link\" href=\"";
        // line 50
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "\">Početna</a>
                            <a class=\"nav-item nav-link\" href=\"";
        // line 51
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "categories\">Kategorije</a><!--Kasnije cemo promeniti da home page ne prikazuje listu kategorija, vec da ovo bude link za to-->
                            <a class=\"nav-item nav-link\" href=\"";
        // line 52
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/profile\">Profil</a><!--Za sada kao da smo ulogovani korisnici, mozda KOD NAS treba UKLONITI ovaj link-->
                            <a class=\"nav-item nav-link\" href=\"";
        // line 53
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "contact\">Kontakt</a>
                            <a class=\"nav-item nav-link\" href=\"";
        // line 54
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/logout\">Odjava</a><!--Za sada-->
                        </div>
                    </div>
                </nav>
            </header>

            <main>
                ";
        // line 61
        $this->displayBlock('main', $context, $blocks);
        // line 63
        echo "            </main>
            <footer class=\"page-footer font-small\">
                    <div class=\"footer-copyright text-center py-3\">
                            &copy; 2019 - Antikviteti K&amp;A
                    </div>
            </footer>
        </div>
        <!--<script>const BASE = '";
        // line 70
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "';</script>-->
        <!--Ovde ako budemo imali potrebu za skriptom (.js), koristimo src=\"";
        // line 71
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "/assets/js/nasa_sktipta.js\", gde je BASE prethodno definisana konstanta-->
        <script src=\"";
        // line 72
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/jquery/dist/jquery.min.js\"></script>
        <script src=\"";
        // line 73
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/js/bootstrap.min.js\"></script>

    </body>
</html>";
    }

    // line 4
    public function block_naslov($context, array $blocks = [])
    {
        echo "Početna";
    }

    // line 61
    public function block_main($context, array $blocks = [])
    {
        // line 62
        echo "                ";
    }

    public function getTemplateName()
    {
        return "_global/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 62,  190 => 61,  184 => 4,  176 => 73,  172 => 72,  168 => 71,  164 => 70,  155 => 63,  153 => 61,  143 => 54,  139 => 53,  135 => 52,  131 => 51,  127 => 50,  103 => 29,  97 => 26,  93 => 25,  89 => 24,  85 => 23,  81 => 22,  73 => 17,  69 => 16,  59 => 9,  55 => 8,  51 => 7,  47 => 6,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "_global/index.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\_global\\index.html");
    }
}
