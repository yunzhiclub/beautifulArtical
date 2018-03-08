package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.entity.Contractor;
import org.springframework.data.repository.CrudRepository;

/**
 * 定制师
 */
public interface ContractorRespository extends CrudRepository<Contractor,Long> {

}
