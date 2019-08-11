<?php
    use App\Models\Category;
    function getCategories(){
        $category = new Category();
        $category = $category->getParents();
        ?>
        <li>
            <a href="" class="dropbtn">Categories</a>

            <ul class="dropdown">
                <?php
                    if($category){
                        foreach($category as $parent_info){
                            if($parent_info->child_categories->count() > 0){
                                ?>
                                <li style="width: 250px;"><a href="<?php echo route('category-list',$parent_info->slug);?>"><?php echo $parent_info->title;?></a>
                                    <ul class="dropdown-subcontent">
                                        <?php

                                        foreach($parent_info->child_categories as $childrens){
                                            ?>
                                            <li><a href="<?php echo route('sub-category-list',[$parent_info->slug, $childrens->slug]) ?>"><?php echo $childrens->title?></a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li style="width: 250px;">
                                    <a href="<?php echo route('category-list',$parent_info->slug) ?>"><?php echo $parent_info->title;?></a></li>
                                <?php
                            }
                        }
                    }

                ?>



            </ul>
        </li>
        <?php
    }
