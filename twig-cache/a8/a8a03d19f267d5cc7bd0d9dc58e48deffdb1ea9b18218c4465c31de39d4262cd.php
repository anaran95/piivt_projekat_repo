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

/* Antique/show.html */
class __TwigTemplate_c87abd5953bc77ac0cfe17b7377e86c81a867c5a1cbff3faa603af1c0bfc30e7 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
            'naslov' => [$this, 'block_naslov'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "_global/index.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("_global/index.html", "Antique/show.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<div class=\"row\">
<div class=\"col col-12\">
<div class=\"card\">
<div class=\"card-body\">
<h1>";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "title", [], "any", false, false, false, 8));
        echo "</h1>
<p>";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "brief_description", [], "any", false, false, false, 9));
        echo "</p>
</div>
</div>
</div>
<div class=\"col col-12\">
<div class=\"card\">
<div class=\"card-body\">
<h2>Izgled:</h2>
<p>";
        // line 17
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "detailed_look_description", [], "any", false, false, false, 17));
        echo "</p>
</div>
</div>
</div>
<div class=\"col col-12\">
<div class=\"card\">
<div class=\"card-body\">
<h2>Materijal:</h2>
<p>";
        // line 25
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "detailed_material_description", [], "any", false, false, false, 25));
        echo "</p>
</div>
</div>
</div>
<div class=\"col col-12\">
<div class=\"card\">
<div class=\"card-body\">
<h2>Istorijski kontekst:</h2>
<p>";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "historical_context", [], "any", false, false, false, 33));
        echo "</p>
</div>
</div>
</div>
<div class=\"col col-12\">
<div class=\"card\">
<div class=\"card-body\">
<h2>Zemlja porekla:</h2>
<p>";
        // line 41
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["country"] ?? null), "name", [], "any", false, false, false, 41));
        echo "</p><!--Takodje preko set() metoda-->
</div>
</div>
</div>
<div class=\"col col-12\">
<div class=\"card\">
<div class=\"card-body\">
<h2>Period/godina porekla:</h2> <!--Ili jedno, ili drugo, u zavisnosti koja inf. je dostupna-->
<p>
    ";
        // line 50
        if ((twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "period_of_origin", [], "any", false, false, false, 50) == null)) {
            // line 51
            echo "        ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "year_of_origin", [], "any", false, false, false, 51), "html", null, true);
            echo " <!--Ceo broj-->
    ";
        } else {
            // line 53
            echo "        ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "period_of_origin", [], "any", false, false, false, 53));
            echo "
    ";
        }
        // line 55
        echo "</p>
</div>
</div>
</div>
";
        // line 59
        if ((twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "price", [], "any", false, false, false, 59) != null)) {
            // line 60
            echo "<div class=\"col col-12\">
<div class=\"card\">
<div class=\"card-body\">
<h2>Cena:</h2>
<p>";
            // line 64
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "price", [], "any", false, false, false, 64), "html", null, true);
            echo " EUR</p> <!--Realan broj-->
</div>
</div>
</div>
";
        }
        // line 69
        echo "<div class=\"col col-12\">
<div class=\"card\">
<div class=\"card-body\">
<h2>Adresa na kojoj je antikvitet dostupan na uvid:</h2>
<p>";
        // line 73
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "adress", [], "any", false, false, false, 73));
        echo "</p>
</div>
</div>
</div>
</div>
";
    }

    // line 80
    public function block_naslov($context, array $blocks = [])
    {
        // line 81
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "title", [], "any", false, false, false, 81));
        echo "
";
    }

    public function getTemplateName()
    {
        return "Antique/show.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 81,  166 => 80,  156 => 73,  150 => 69,  142 => 64,  136 => 60,  134 => 59,  128 => 55,  122 => 53,  116 => 51,  114 => 50,  102 => 41,  91 => 33,  80 => 25,  69 => 17,  58 => 9,  54 => 8,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Antique/show.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\Antique\\show.html");
    }
}
