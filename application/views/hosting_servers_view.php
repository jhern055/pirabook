<div class="server">
        <div class="form-group">
        <label for="HostingServers">Servidor</label>
        <?php $attributes = 'id="hostingServers"'; ?>
        <?php echo form_dropdown('hosting_servers',$hosting_servers,'',$attributes); ?>
        </div>
        
        <div class="form-group">
        <label for="links">Descripcion breve de los links</label>

        <?php $data = array(
                'name'=> 'description_links',
                'id'=> 'description_links',
                'placeholder'=> 'Descripción de links',
                'class'=> 'form-control',
                'tabindex'=> 11,
                'value'=> $this->input->post("description_links")
                );
          ?>
        <?php echo form_input($data); ?>
        </div>  
        
        <div class="form-group">
        <label for="links">links</label>

        <?php $data = array(
                'name'=> 'links',
                'id'=> 'links',
                'title'=> 'links separados por comas',
                'placeholder'=> 'Separados por comas link,link2,link3',
                'class'=> 'form-control',
                'tabindex'=> 11,
                'value'=> $this->input->post("link")
                );
          ?>
        <?php echo form_textarea($data); ?>
        </div>  
</div>  