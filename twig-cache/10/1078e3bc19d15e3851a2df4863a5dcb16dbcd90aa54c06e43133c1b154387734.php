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

/* AdministratorAntiqueManagement/getEdit.html */
class __TwigTemplate_e2a5093fed6f2e656ed8d7524a7f7f47c401e9e318cb804671c977884f687b4f extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "_global/index.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("_global/index.html", "AdministratorAntiqueManagement/getEdit.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<div>
    <div class=\"options\">
        <a href=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/antiques\">Nazad na spisak antikviteta</a>
    </div>

    <!--forma za izmenu antikviteta-->
    <form class=\"auction-form\" method=\"POST\" enctype=\"multipart/form-data\" onsubmit=\"return validateAntiqueEditForm();\">
        <div>
            <label for=\"title\">Naslov antikviteta:</label>
            <input type=\"text\" id=\"title2\" name=\"title\" required value=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "title", [], "any", false, false, false, 13), "html", null, true);
        echo "\">
        </div>
        <div>
            <label for=\"image_path\">Slika antikviteta:</label> <!--za sada tekst-->
            <input type=\"file\" id=\"image_path\" name=\"image_path\" accept=\"image/jpeg\">
            <!--<label for=\"image_path\">Slika antikviteta:</label>-->
            <!--<input type=\"text\" id=\"image_path\" name=\"image_path\" required value=\"";
        // line 19
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "image_path", [], "any", false, false, false, 19), "html", null, true);
        echo "\">-->
        </div>
        <div>
            <label for=\"detailed_look_description\">Detaljan opis izgleda:</label>
            <textarea id=\"detailed_look_description\" name=\"detailed_look_description\" rows=\"10\" required pattern=\".*[^\\s]{2,}.*\">";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "detailed_look_description", [], "any", false, false, false, 23), "html", null, true);
        echo "</textarea>
        </div>
        <div>
            <label for=\"detailed_material_description\">Detaljan opis materijala:</label>
            <textarea id=\"detailed_material_description\" name=\"detailed_material_description\" rows=\"10\" required pattern=\".*[^\\s]{2,}.*\">";
        // line 27
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "detailed_material_description", [], "any", false, false, false, 27), "html", null, true);
        echo "</textarea>
        </div>
        <div>
            <label for=\"brief_description\">Kratak opis:</label>
            <textarea id=\"brief_description2\" name=\"brief_description\" rows=\"10\" required>";
        // line 31
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "brief_description", [], "any", false, false, false, 31), "html", null, true);
        echo "</textarea>
        </div>
        <div>
            <label for=\"historical_context\">Istorijski kontekst:</label>
            <textarea id=\"historical_context\" name=\"historical_context\" rows=\"10\" required pattern=\".*[^\\s]{2,}.*\">";
        // line 35
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "historical_context", [], "any", false, false, false, 35), "html", null, true);
        echo "</textarea>
        </div>
        <div>
            <label for=\"country_of_origin_id\">Zemlja porekla:</label>
            <select id=\"country_of_origin_id\" name=\"country_of_origin_id\">
                ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 41
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["country"], "country_of_origin_id", [], "any", false, false, false, 41), "html", null, true);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "country_of_origin_id", [], "any", false, false, false, 41) == twig_get_attribute($this->env, $this->source, $context["country"], "country_of_origin_id", [], "any", false, false, false, 41))) {
                echo "selected";
            }
            echo ">
                        ";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 42));
            echo "
                    </option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "            </select>
        </div>
        <div>
            <label for=\"period_of_origin\">Period porekla (opciono, ako je popunjena godina):</label>
            <textarea id=\"period_of_origin\" name=\"period_of_origin\" rows=\"2\" pattern=\".*[^\\s]{2,}.*\">";
        // line 49
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "period_of_origin", [], "any", false, false, false, 49), "html", null, true);
        echo "</textarea>
        </div>
        <div>
            <label for=\"year_of_origin\">Godina porekla (opciono, ako je popunjen period):</label>
            <input type=\"text\" id=\"year_of_origin\" name=\"year_of_origin\" value=\"";
        // line 53
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "year_of_origin", [], "any", false, false, false, 53), "html", null, true);
        echo "\" pattern=\"[1-2]{1}[0-9]{3}\">
        </div>
        <div>
            <label for=\"price\">Cena (opciono):</label>
            <input type=\"text\" id=\"price\" name=\"price\" value=\"";
        // line 57
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "price", [], "any", false, false, false, 57), "html", null, true);
        echo "\" pattern = \"[1-9][0-9]{0,}(\\.[0-9]{2,})?\">
        </div>
        <div>
            <label for=\"adress\">Adresa na kojoj je dostupan na uvid:</label>
            <textarea id=\"adress\" name=\"adress\" rows=\"2\" required pattern=\".*[^\\s]{2,}.*\">";
        // line 61
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["antique"] ?? null), "adress", [], "any", false, false, false, 61), "html", null, true);
        echo "</textarea>
        </div>
        <div>
            <label for=\"kategorije[]\">Kategorije kojima pripada (Ctrl + klik za izbor vise opcija):</label>
            <select id=\"kategorije\" name=\"kategorije[]\" multiple=\"multiple\">
                ";
        // line 66
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 67
            echo "                
                    ";
            // line 68
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["antiqueCategories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["antiqueCategory"]) {
                // line 69
                echo "                    <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 69), "html", null, true);
                echo "\" ";
                if ((twig_get_attribute($this->env, $this->source, $context["antiqueCategory"], "category_id", [], "any", false, false, false, 69) == twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 69))) {
                    echo "selected";
                }
                echo ">
                        ";
                // line 70
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 70));
                echo "
                    </option>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['antiqueCategory'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 73
            echo "                
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "            </select>
        </div>
        <div>
            <button type=\"submit\">
                Sačuvaj izmene
            </button>
        </div>
        <div class=\"alert alert-warning d-none\" id=\"error-message2\"></div>
    </form>

    <script src=\"";
        // line 85
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/formValidation.js\"></script>
    
</div>
";
    }

    public function getTemplateName()
    {
        return "AdministratorAntiqueManagement/getEdit.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  211 => 85,  199 => 75,  192 => 73,  183 => 70,  174 => 69,  170 => 68,  167 => 67,  163 => 66,  155 => 61,  148 => 57,  141 => 53,  134 => 49,  128 => 45,  119 => 42,  110 => 41,  106 => 40,  98 => 35,  91 => 31,  84 => 27,  77 => 23,  70 => 19,  61 => 13,  51 => 6,  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "AdministratorAntiqueManagement/getEdit.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\AdministratorAntiqueManagement\\getEdit.html");
    }
}
