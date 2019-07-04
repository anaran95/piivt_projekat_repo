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

/* Category/show.html */
class __TwigTemplate_7ec358482f90a674baef837507fd184c2a5e998bcd1a64d0ddaeeeb9f037572d extends \Twig\Template
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
        $this->parent = $this->loadTemplate("_global/index.html", "Category/show.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<!--<h1>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["category"] ?? null), "name", [], "any", false, false, false, 4));
        echo "</h1>
<p>Spisak antikviteta u ovoj kategoriji je:</p>-->
<div class=\"row\">

    ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["antiquesInCategory"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["antique"]) {
            // line 9
            echo "    <div class=\"card border-primary col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 text-center category\">
    
        <a href=\"";
            // line 11
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "antique/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "antique_id", [], "any", false, false, false, 11), "html", null, true);
            echo "\" class=\"antique-image\"> <!--OVDE TREBA KLASA -image ? -->
            <img class=\"card-img-top\" src=\"";
            // line 12
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "assets/uploads/id";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "antique_id", [], "any", false, false, false, 12), "html", null, true);
            echo ".jpg\" alt=\"Slika - ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "antique_id", [], "any", false, false, false, 12), "html", null, true);
            echo "\"> <!--PROMENITI SRC KASNIJE-->
        </a>
        <a href=\"";
            // line 14
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "antique/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "antique_id", [], "any", false, false, false, 14), "html", null, true);
            echo "\" class=\"card-title\"><!--Ruta ka podacima o antikvitetu-->
            ";
            // line 15
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "title", [], "any", false, false, false, 15));
            echo "
        </a>
        <span class=\"antique-brief-description\">";
            // line 17
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "brief_description", [], "any", false, false, false, 17));
            echo "</span> <!--Za sada ovo samo-->
        <span class=\"antique-price\">
            ";
            // line 19
            if ((twig_get_attribute($this->env, $this->source, $context["antique"], "price", [], "any", false, false, false, 19) != null)) {
                // line 20
                echo "                ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "price", [], "any", false, false, false, 20), "html", null, true);
                echo " &euro;
            ";
            } else {
                // line 22
                echo "                Nije na prodaju
            ";
            }
            // line 24
            echo "        </span>
        <span class=\"antique-address\">";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["antique"], "adress", [], "any", false, false, false, 25), "html", null, true);
            echo "</span>
        
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['antique'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "
</div>
<!--<p>Kategorija je kreirana: ";
        // line 31
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["category"] ?? null), "created_at", [], "any", false, false, false, 31), "html", null, true);
        echo "</p>
<p>ID administratora koji je poslednji vršio izmene je: ";
        // line 32
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["category"] ?? null), "administrator_id", [], "any", false, false, false, 32), "html", null, true);
        echo "</p>-->
";
    }

    // line 35
    public function block_naslov($context, array $blocks = [])
    {
        // line 36
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["category"] ?? null), "name", [], "any", false, false, false, 36));
        echo "
";
    }

    public function getTemplateName()
    {
        return "Category/show.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 36,  134 => 35,  128 => 32,  124 => 31,  120 => 29,  110 => 25,  107 => 24,  103 => 22,  97 => 20,  95 => 19,  90 => 17,  85 => 15,  79 => 14,  70 => 12,  64 => 11,  60 => 9,  56 => 8,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Category/show.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\Category\\show.html");
    }
}
